<?php

namespace App\Presenters;

use App\Components\IProposalTableFactory;
use App\Repository\ProposalRepository;
use App\Repository\UserRepository;
use Nette;
use App\Model;


class HomepagePresenter extends SecuredPresenter
{

    private $proposalRepository;

    private $userRepository;

    private $proposalTableFactory;

    /**
     * HomepagePresenter constructor.
     * @param $proposalRepository
     */
    public function __construct(
        ProposalRepository $proposalRepository,
        UserRepository $userRepository,
        IProposalTableFactory $proposalTableFactory)
    {
        $this->userRepository = $userRepository;
        $this->proposalRepository = $proposalRepository;
        $this->proposalTableFactory = $proposalTableFactory;
    }


    public function renderDefault()
    {

    }

    public function createComponentMyProposals()
    {
        $currentUser = $this->userRepository->findOneBy(array('id' => $this->user->getId()));
        return $this->proposalTableFactory->create($this->proposalRepository->findAllForUser($currentUser)); //TODO zobrazovat pouze ty patrici prihlasenemu
    }

}
