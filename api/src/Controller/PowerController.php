<?php

namespace App\Controller;

use App\Entity\Power;
use App\Repository\PowerRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/powers")
 */
class PowerController extends AbstractController
{
    /**
     * @Route("/", name="app_powers_list", methods={"GET"})
     */
    public function list(PowerRepository $powerRepository): JsonResponse
    {
        $powers = $powerRepository->findAll();

        return $this->json($powers);
    }

    /**
     * @Route("/", name="app_powers_create", methods={"POST"})
     */
    public function create(
        Request $request,
        PowerRepository $powerRepository,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = $request->toArray();

        $power = new Power();
        $power->setName($data['name']);
        $power->setCode($data['code']);

        // Return errors
        $errors = $validator->validate($power);
        if (count($errors) > 0) {
            $errorsArray = [];
            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json(
                [
                    'errors' => $errorsArray
                ],
                200
            );
        }

        $powerRepository->add($power, true);

        return $this->json(
            $power,
            201
        );
    }

    /**
     * @Route("/{id}", name="app_powers_read", methods={"GET"})
     */
    public function read(Request $request, PowerRepository $powerRepository): JsonResponse
    {
        $power = $powerRepository->find($request->get('id'));
        if (!$power) {
            return $this->json(
                [
                    'errors' => "Not Found"
                ],
                404
            );
        }

        return $this->json($power);
    }

    /**
     * @Route("/{id}", name="app_powers_update", methods={"PUT"})
     */
    public function update(
        Request $request,
        PowerRepository $powerRepository,
        ValidatorInterface $validator
    ): JsonResponse {
        $power = $powerRepository->find($request->get('id'));
        if (!$power) {
            return $this->json(
                [
                    'errors' => "Not Found"
                ],
                404
            );
        }

        $data = $request->toArray();

        $power->setName($data['name']);
        $power->setCode($data['code']);

        // Return errors
        $errors = $validator->validate($power);
        if (count($errors) > 0) {
            $errorsArray = [];
            foreach ($errors as $error) {
                $errorsArray[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json(
                [
                    'errors' => $errorsArray
                ],
                200
            );
        }

        $powerRepository->add($power, true);

        return $this->json(
            $power,
            200
        );
    }

    /**
     * @Route("/{id}", name="app_powers_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PowerRepository $powerRepository): JsonResponse
    {
        $power = $powerRepository->find($request->get('id'));
        if (!$power) {
            return $this->json(
                [
                    'errors' => "Not Found"
                ],
                404
            );
        }

        $powerRepository->remove($power, true);

        return $this->json(
            $power,
            200
        );
    }
}
