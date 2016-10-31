<?php

class Humans extends Controller
{
    private static $allowed_actions = array(
        'index'
    );

    /**
     * Render the Humans template
     *
     * @return SS_HTTPResponse
     */
    public function index()
    {
        $data = new ArrayData(array(
            'LastUpdate' => date('Y-m-d', strtotime($this->getLatestPageUpdate()))
        ));

        $humans = $data->renderWith(array('Humans'));

        $response = new SS_HTTPResponse($humans, 200);
        $response->addHeader("Content-Type", "text/plain; charset=\"utf-8\"");

        return $response;
    }

    /**
     * Get latest page update time
     *
     * @return DateTime
     */
    private function getLatestPageUpdate()
    {
        return DB::query("SELECT MAX(\"LastEdited\") FROM \"SiteTree_Live\"")->value();
    }
}
