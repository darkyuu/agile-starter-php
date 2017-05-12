<?php
# features/bootstrap/FeaturesContext.php

require("src\Phpadder.php");

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

class FeatureContext extends BehatContext {

    private $Adder;

    /**
     * @Given /^I have the number (\d+) and the number (\d+)$/
     */
    public function iHaveTheNumberAndTheNumber($a, $b) {
        $this->Adder = new Phpadder($a, $b);
    }

    /**
     * @When /^I add them together$/
     */
    public function iAddThemTogether() {
        $this->Adder->add();
    }

    /**
     * @Then /^I should get (\d+)$/
     */
    public function iShouldGet($sum) {
        if ($this->Adder->sum != $sum) {
            throw new Exception("Actual sum: ".$this->Adder->sum);
        }
        $this->Adder->display();
    }
}
