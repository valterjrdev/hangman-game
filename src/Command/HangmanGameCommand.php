<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Output\ConsoleOutput;
use App\Words\Datasource\FileDatasource;
use App\Words\WordGenerator;
use App\Words\WordInterface;
use App\Game\HangmanGame;

class HangmanGameCommand extends Command
{
    protected static $defaultName = 'app:game';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $object = new WordGenerator(new FileDatasource(sprintf("%s/../resources/words.txt", dirname(__DIR__))));
        $word = $object->generate();
        $helper = $this->getHelper('question');

        $game = new HangmanGame($word);

        /**
         * @var ConsoleOutput $output
         */
        $section = $output->section();

        while (true) {
            $section->writeln($this->display($game, $word));

            $question = new Question('Digite a letra: ', '');
            $letter = $helper->ask($input, $output, $question);

            $game->input($letter);

            if (!$game->tryAgain()) {
                $section->clear();
                $section->writeln($this->display($game, $word));

                $section->writeln([
                    "",
                    "Você errou!"
                ]);

                return Command::FAILURE;
            }

            if ($game->win()) {
                $section->clear();
                $section->writeln($this->display($game, $word));

                $section->writeln([
                    "",
                    "Você acertou!"
                ]);

                return Command::SUCCESS;
            }

            $section->clear();
        }
    }


    /**
     * @param HangmanGame $game
     * @param WordInterface $word
     *
     * @return array<string>
     */
    private function display(HangmanGame $game, WordInterface $word): array
    {
        return [
            sprintf("Palavra: %s", $game->getWordMask()),
            "",
            sprintf("Dica: %s", $word->getSuggestion()),
            sprintf("Tentivas restante: %s", $game->getAttempts()),
        ];
    }
}
