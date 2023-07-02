<?php

namespace App\Service;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * General App Service
 * which provides various stuff, and not related to any services
 */
class AppService
{
    /** @var Serializer */
    private $serializer;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [
            new ArrayDenormalizer(),
            // new DateTimeNormalizer(),
            new ObjectNormalizer(
                null,
                null,
                null,
                new ReflectionExtractor()
            ),
        ];

        $this->serializer = new Serializer($normalizers, $encoders);
    }

    /**
     * Get the serializer
     * @return Serializer
     */
    public function getSerializer() {
        return $this->serializer;;
    }

    /**
     * Method to get all errors from the form
     * @return array
     */
    public function getFormErrors(FormInterface $form): array
    {
        $errors = [];

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                foreach ($form->all() as $child) {
                    if (!$child->isValid()) {
                        $messages = [];

                        foreach ($child->getErrors() as $error) {
                            $messages[] = $error->getMessage();
                        }

                        $errors[$child->getName()] = $messages;
                    }
                }
            }
        }

        return $errors;
    }
}
