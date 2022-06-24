<?php

namespace App\Controller\BackOffice;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Intl\Languages;

#[Route('/translation')]
class TranslationController extends AbstractController
{
    #[Route('/', name: 'app_translation_index', methods: ['GET'])]
    public function index(): Response
    {
        $langsJson = file_get_contents($this->getParameter('locales_directory') . '/langs.json');
        $allLangs = json_decode($langsJson, true)['allLangs'];

        $langsTranslation = [];
        foreach ($allLangs as $k => $v)
        {
            $json = file_get_contents($this->getParameter('locales_directory') . '/' . $v . '/translation.json');
            $langsTranslation[$v] = json_decode($json, true);
            var_dump($langsTranslation[$v]);
        }

        return $this->render('translation/index.html.twig', [
            'translations' => $langsTranslation,
        ]);
    }

    #[Route('/new', name: 'app_translation_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $langsJson = file_get_contents($this->getParameter('locales_directory') . '/langs.json');
        $allLangs = json_decode($langsJson, true)['allLangs'];

        if ($request->isMethod('post')) {
            $filesystem = new Filesystem();

            // Save json to new locale
            $requestArray = $request->request->all();
            $locale = $requestArray['newLang'];
            unset($requestArray['newLang']);
            $jsonTranslation = json_encode($requestArray);

            $filePathTranslation = $this->getParameter('locales_directory') . '/' . $locale . '/translation.json';
            $filesystem->dumpFile($filePathTranslation, $jsonTranslation);

            // Add new locale to alllangs
            $locales = json_decode($langsJson, true);
            array_push($allLangs, $locale);
            $locales['allLangs'] = $allLangs;
            $jsonLocales = json_encode($locales);

            $filePathLocales = $this->getParameter('locales_directory') . '/langs.json';
            $filesystem->dumpFile($filePathLocales, $jsonLocales);

            return $this->redirectToRoute('app_translation_index', [], Response::HTTP_SEE_OTHER);
        }

        $langsTranslation = [];
        foreach ($allLangs as $k => $v)
        {
            $json = file_get_contents($this->getParameter('locales_directory') . '/' . $v . '/translation.json');
            $langsTranslation[$v] = json_decode($json, true);
        }

        $langsToAdd = [];
        foreach(Languages::getNames('fr') as $k => $v)
        {
            $isLangValid = true;
            foreach($allLangs as $k2 => $v2)
            {
                if (strtolower($k) == strtolower($v2))
                {
                    $isLangValid = false;
                    break;
                }
            }

            if ($isLangValid)
            {
                $langsToAdd[$k] = $v;
            }
        }
        
        return $this->render('translation/new.html.twig', [
            'translations' => $langsTranslation,
            'langs' => $langsToAdd
        ]);
    }

    #[Route('/{locale}/edit', name: 'app_translation_edit', methods: ['GET', 'POST'])]
    public function edit(string $locale, Request $request): Response
    {
        if ($request->isMethod('post')) {
            $filesystem = new Filesystem();

            // Save to file
            $json = json_encode($request->request->all());
            $filePath = $this->getParameter('locales_directory') . '/' . $locale . '/translation.json';
            $filesystem->dumpFile($filePath, $json);

            return $this->redirectToRoute('app_translation_index', [], Response::HTTP_SEE_OTHER);
        }

        $langsJson = file_get_contents($this->getParameter('locales_directory') . '/langs.json');
        $allLangs = json_decode($langsJson, true)['allLangs'];

        $langsTranslation = [];
        foreach ($allLangs as $k => $v)
        {
            $json = file_get_contents($this->getParameter('locales_directory') . '/' . $v . '/translation.json');
            $langsTranslation[$v] = json_decode($json, true);
        }
        
        return $this->render('translation/edit.html.twig', [
            'translations' => $langsTranslation,
            'locale' => $locale
        ]);
    }
}
