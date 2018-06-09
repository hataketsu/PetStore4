<?php

namespace Tests\Feature;

use Hamcrest\Core\Set;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSetContact()
    {
        $currentContactEmail = \Setting::get('email'); //get current email
        $this->visit('/')->see($currentContactEmail);   //check if we can see it
        $nope_email = 'nope_email@gmail';   //a fake email
        \Setting::set('email', $nope_email);    //set it
        $this->visit('/')->see($nope_email);    //check if the email has been updated
        \Setting::set('email', $currentContactEmail);   //set back old email
    }

    public function testMoreLinks()
    {
        $testLinks = ["Tutorial 1234567" => '/help'];
        $key = 'more_links';                            //setting key of more_links
        $links = \Setting::get($key, []);               //get current links list
        $links = collect($links);                       //convert to collection to easier working
        $addedlinks = $links->merge($testLinks);        //add new test link
        \Setting::set($key, $addedlinks);               //save setting
        $this->visit('/')->see("Tutorial 1234567"); //we should see the new link now
        \Setting::set($key, $links);                    //set back the old links list
        $this->visit('/')->dontSee("Tutorial 1234567"); //shouldn't see the test link now
    }
}
