<?php

class Humans extends Controller
{
    private static $allowed_actions = array(
        'index'
    );

    public function index(SS_HTTPRequest $request)
    {
        $data = new ArrayData(array(
            'LastUpdate' => $this->getLatestUpdateDate()
        ));

        $humans = $this->renderWith(array('Humans'));

        $response = new SS_HTTPResponse($humans, 200);
        $response->addHeader("Content-Type", "text/plain; charset=\"utf-8\"");

        return $response;
    }

    private function getLatestUpdateDate()
    {
        return DB::query("SELECT MAX(\"LastEdited\") FROM \"SiteTree_Live\"")->value();
    }
}
