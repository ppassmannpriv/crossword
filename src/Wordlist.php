<?php

namespace Crossword;

class Wordlist {

    private $seed = [
        ["ARZTWIDERWILLEN", "OPER VON GOUNOD"],
	    ["WELLAT", "PAPAGEIENART"],
	    ["BIERHAHN", "PIROLART"],
	    ["EHEFRAU", "GATTIN"],
	    ["MAIKAMMER", "WEINORT IN RHEINLAND - PFALZ"],
	    ["PICO", "ITALIENISCHER PHILOSOPH"],
	    ["PRANGER", "MITTELALTERLICHER SCHANDPFAHL"],
	    ["DICHTE", "PHYSIKALISCHER BEGRIFF"],
	    ["SCHMAUS", "FESTESSEN"],
	    ["ANTHOLOGIE", "BLÜTENLESE"],
	    ["VERZINNEREI", "INDUSTRIE, GEWERBEBETRIEB"],
	    ["KRU", "AFRIKANISCHE SPRACHE"],
	    ["NORMAL", "REGELMÄSSIG"],
        ["CHARME", "WAFFE EINER FRAU"],
    	["MITINHABER", "SOZIUS"],
	    ["PFERCH", "EINGEZÄUNTE FLÄCHE FÜR TIERE"],
	    ["BITTERSEE", "AFRIKANISCHER SEE"],
	    ["SCHLAEFE", "TEIL DES SCHÄDELS"],
	    ["KONFORM", "EINIG"],
	    ["MOGUL", "MORGENLÄNDISCHER HERRSCHER"],
	    ["REESER", "NIEDERLÄNDISCHER MUSIKFORSCHER"],
	    ["LINIENNETZ", "BAHNSTRECKENWERK"],
	    ["AKT", "TAKT"],
    	["IROKESE", "NORDAMERIKANISCHER INDIANER"],
	    ["RUSTIKAL", "BÄUERLICH, LÄNDLICH, SCHLICHT"]
    ];
    protected $list;

    public function __construct()
    {
        $this->buildListFromSeed();
    }

    private function buildListFromSeed()
    {
        foreach($this->seed as $seed)
        {
            $this->list[] = new Word($seed[0], $seed[1]);
        }
    }

    private function seedList()
    {
        /**
         * @TODO: load random words from assets/words.json
         */
    }

    private function sortList()
    {
        usort($this->list, function($a, $b) {
            if($b->getLength() == $a->getLength()) { return 0; }
            return ($b->getLength() < $a->getLength()) ? -1 : 1;
        });
    }

    public function getList()
    {
        $this->sortList();
        return $this->list;
    }

}