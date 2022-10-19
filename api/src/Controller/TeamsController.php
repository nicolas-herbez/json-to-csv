<?php

namespace App\Controller;

use App\Service\EncodeToCsv;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamsController extends AbstractController
{
    /**
     * @Route("/api/teams", name="app_teams", methods={"POST"})
     */
    public function createTeamsCsv(Request $request, EncodeToCsv $encodeToCsv): Response
    {
        $jsonDecoded = $request->toArray();
        $teamsList = $jsonDecoded['teams'];
        // dd($teamsList);

        $teamsHeaders = [
            "Squad Name",
            "HomeTown",
            "Formed Year",
            "Base",
            "Number of members",
            "Average Age",
            "Average strengh of team",
            "Is Active"
        ];

        $teams = [];
        for ($i = 0; $i < count($teamsList); $i++) {
            $team = [];

            $team[$teamsHeaders[0]] = $teamsList[$i]['squadName'];
            $team[$teamsHeaders[1]] = $teamsList[$i]['homeTown'];
            $team[$teamsHeaders[2]] = $teamsList[$i]['formed'];
            $team[$teamsHeaders[3]] = $teamsList[$i]['secretBase'];

            // Calculation of the number of members for a team
            $numberOfMembers = count($teamsList[$i]['members']);
            $team[$teamsHeaders[4]] = $numberOfMembers;

            // Calculation of the average age for a team
            if ($numberOfMembers > 0) {
                $sumOfAges = 0;
                foreach ($teamsList[$i]['members'] as $member) {
                    $sumOfAges += $member['age'];
                }
                $averageAge = number_format($sumOfAges / $numberOfMembers, 2, ",", " ");
                $team[$teamsHeaders[5]] = str_replace(",00", "", $averageAge);
            } else {
                $team[$teamsHeaders[5]] = 0;
            }

            $team[$teamsHeaders[6]] = "";
            $team[$teamsHeaders[7]] = ($teamsList[$i]['active']) ? "yes" : "no" ;

            $teams[] = $team;
        }

        // Encode to csv
        $teamsCsv = $encodeToCsv->encode($teamsHeaders, $teams);

        return new Response(
            $teamsCsv,
            200,
            [
                'Content-Type' => 'application/vnd.ms-excel',
                "Content-disposition" => "attachment; filename=teams.csv"
            ]
        );
    }
}
