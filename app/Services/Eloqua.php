<?php

namespace App\Services;

// Deps
use Cache;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Eloqua
{
    /**
     * Guzzle client
     *
     * @var Client
     */
    protected $client;

    /**
     * DI
     */
    public function __construct()
    {
        if (!app()->environment('testing')) {
            $this->client = new Client([
                'base_uri' => $this->endpoint(),
                'auth' => $this->auth(),
            ]);
        }
    }

    /**
     * Make the Eloqua endpoint
     *
     * @return string
     */
    public function endpoint()
    {
        $client = new Client([
            'base_uri' => 'https://login.eloqua.com/',
            'auth' => $this->auth(),
        ]);
        $response = json_decode($client->get('id')->getBody());
        if (is_string($response)) {
            throw new Exception('Eloqua endpoint error: '.$response);
        } else {
            return $response->urls->base.'/api/rest/2.0/';
        }
    }

    /**
     * Make the basic auth key pair
     *
     * @return array
     */
    public function auth()
    {
        return [
            env('ELOQUA_COMPANY').'\\'.env('ELOQUA_USERNAME'),
            env('ELOQUA_PASSWORD')
        ];
    }

    /**
     * Submit the gate form
     *
     * @param  integer $form_id
     * @param  array $data
     * @return void
     */
    public function submit($form_id, $data)
    {
        $this->client->post('data/form/'.$form_id, [
            'json' => $this->formatData($form_id, $data),
        ]);
    }

    /**
     * Format the data request data form Eloqua
     *
     * @param  integer $form_id
     * @param  array $data
     * @return array
     */
    public function formatData($form_id, $data)
    {
        return [
            'fieldValues' => array_map(function ($val, $key) use ($form_id) {
                return [
                    'type' => 'FieldValue',
                    'id' => $this->fieldId($form_id, $key),
                    'value' => $val,
                ];
            }, $data, array_keys($data)),
        ];
    }

    /**
     * Lookup up the id of a field in Eloqua
     *
     * @param  integer $form_id
     * @param  string $key
     * @return integer
     */
    public function fieldId($form_id, $key)
    {
        $form = $this->getForm($form_id);
        return array_first($form->elements, function ($element) use ($key) {
            return $element->type == 'FormField' && $element->htmlName == $key;
        })->id;
    }

    /**
     * Lookup the form by id in Eloqua
     *
     * @param string $form_id
     * @return object
     */
    public function getForm($form_id)
    {
        return Cache::remember('eloqua-'.$form_id, 60, function () use ($form_id) {
            $response = $this->client->get('assets/form/'.$form_id);
            return json_decode($response->getBody());
        });
    }

    /**
     * Lookup the form with options by id in Eloqua
     *
     * @param string $form_id
     * @return array
     */
    public function getFormWithOptions($form_id)
    {
        return array_map(function($element) {
            return [
                'type' => $element->displayType,
                'name' => $element->htmlName,
                'label' => $element->name,
                'id' => $element->id,
                'options' => $this->lookupOptions($element->optionListId ?? null),
            ];
        }, $this->getForm($form_id)->elements);
    }

    /**
	 * Lookup an options list as an array for Former
	 *
	 * @param  integer $id
	 * @return array
	 */
	public function lookupOptions($id) {
        if (!$id) return;
        return Cache::remember('eloqua-options-'.$id, 60, function () use ($id) {
            $response = $this->client->get('assets/optionList/'.$id);
			$json = json_decode($response->getBody());

			// Make an associative array from the response.  Sometimes a value
			// isn't present
			$options = [];
			foreach($json->elements as $element) {
				$value = isset($element->value) ? $element->value : '';
				$options[$value] = $element->displayName;
			}
			return $options;
        });
	}
}
