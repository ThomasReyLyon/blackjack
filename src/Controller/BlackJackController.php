<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlackJackController extends AbstractController
{
    /**
     * @Route("/black/jack", name="black_jack")
     */
    public function play($player, $bank)
    {
		$scoreP = 0;
		$scoreB = 0;

		$i = 0;
		$compteurAsP = 0;
		$compteurAsB = 0;

		while ($scoreB < 21 || $scoreP < 21) {

				if(array_key_exists($i, $player)){

					if (is_int($player[$i])) {
						$scoreP += $player[$i];
					} else if ($player[$i] != 'A') {
						$scoreP += 10;
					} else {
							$scoreP += 1;
							$compteurAsP += 1;
					}
				} // fin else Player
				if ($scoreP > 21) {
					return 'bank';
				}

				if(array_key_exists($i, $bank)) {
					if (is_int($bank[$i])) {
						$scoreB += $bank[$i];
					} else if ($bank[$i] != 'A') {
						$scoreB += 10;
					} else {
							$scoreB += 1;
							$compteurAsB += 1;

					}
				} // fin else Bank
				if ($scoreB > 21) {
					return 'player';
				}

				if ($scoreB == 21 && $scoreP == 21) {
					return 'bank';
				}

				if(!array_key_exists($i, $player) || !array_key_exists($i, $bank)){
					if ($compteurAsP!=0) {
						if (21 - $scoreP <=10){
							$scoreP+=10;
						}
					}
					if ($compteurAsB!=0) {
						if (21 - $scoreB <=10){
							$scoreB+=10;
						}
					}
					if ($scoreB < $scoreP) {
						return 'player';
					}
					if ($scoreB > $scoreP) {
						return 'bank';
					}
					if ($scoreB == $scoreP) {
						return 'bank';
					}
				}
				$i++;

		} // fin du While

		return $this->render('black_jack/index.html.twig', [
			'controller_name' => 'BlackJackController',
		]);
		}
}

//$player = [10, 2, 'V', 'A'];
//		$bank = [3, 5, 'D', 'R'];

/*if (21 - $scoreB >= 11) {
	$scoreB += 11;
} else {