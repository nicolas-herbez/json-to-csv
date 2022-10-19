<?php

namespace App\Controller;

use App\Repository\PowerRepository;
use App\Service\EncodeToCsv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamMembersController extends AbstractController
{
    /**
     * @Route("/api/team-members", name="app_team_members", methods={"POST"})
     */
    public function createTeamMembersCsv(
        Request $request,
        PowerRepository $powerRepository,
        EncodeToCsv $encodeToCsv
    ): Response {
        $jsonDecoded = $request->toArray();
        $teamsList = $jsonDecoded['teams'];
        // dd($teamsList);

        $powerCodeList = $powerRepository->findAllNameAndCode();
        // dd($powerCodeList);

        $teamMembersHeaders = [
            "Squad Name",
            "HomeTown",
            "Name",
            "Secret ID",
            "Age",
            "Number of Power",
            "Average strengh of member",
            "Power1"
        ];

        $teamMembers = [];
        for ($i = 0; $i < count($teamsList); $i++) {
            for ($j = 0; $j < count($teamsList[$i]['members']); $j++) {
                $member = $teamsList[$i]['members'][$j];

                $memberInfos = [];
                $memberInfos[$teamMembersHeaders[0]] = $teamsList[$i]['squadName'];
                $memberInfos[$teamMembersHeaders[1]] = $teamsList[$i]['homeTown'];
                $memberInfos[$teamMembersHeaders[2]] = $member['name'];
                $memberInfos[$teamMembersHeaders[3]] = $member['secretIdentity'];
                $memberInfos[$teamMembersHeaders[4]] = $member['age'];

                // Calculation of the number of powers for a member
                $numberOfPowers = (is_countable($member["powers"])) ? count($member["powers"]) : 0 ;
                $memberInfos[$teamMembersHeaders[5]] = $numberOfPowers;

                $memberInfos[$teamMembersHeaders[6]] = "";

                // Powers list for a member
                if (is_countable($member['powers'])) {
                    for ($k = 0; $k < count($member['powers']); $k++) {
                        // Rename power headers
                        $teamMembersHeaders[7 + $k] = "Power" . (1 + $k);

                        // Mapping Power Name / PowerCode
                        $code = false;
                        foreach ($powerCodeList as $value) {
                            if ($value['name'] == $member['powers'][$k]) {
                                $code = $value['code'];
                            }
                        }
                        $powerCode = ($code) ? $code : "no code" ;
                        $memberInfos[$teamMembersHeaders[7 + $k]] = $powerCode;
                    }
                } else {
                    $memberInfos[$teamMembersHeaders[7]] = "";
                }

                $teamMembers[] = $memberInfos;
            }
        }

        // Encode to csv
        $teamMembersCsv = $encodeToCsv->encode($teamMembersHeaders, $teamMembers);

        return new Response(
            $teamMembersCsv,
            200,
            [
                'Content-Type' => 'application/vnd.ms-excel',
                "Content-disposition" => "attachment; filename=team_members.csv"
            ]
        );
    }
}
