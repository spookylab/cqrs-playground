<?php

namespace CqrsPlayground\Application\Command;

use CqrsPlayground\Application\Models\CompanyUsers;
use CqrsPlayground\Domain\Requirements\CompanyUser\Entity;
use CqrsPlayground\Domain\Requirements\CompanyUser\Requirements;
use CqrsPlayground\Domain\Requirements\RequirementsNotMetException;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Validation\Message;

class CreateCompanyUserCommandHandler
{
    private $eventsManager;

    public function __construct(EventsManager $eventsManager)
    {
        $this->eventsManager = $eventsManager;
    }

    public function __invoke(CreateCompanyUserCommand $command)
    {
        $phone = $command->getPhone();

        $numberOfUsers = CompanyUsers::count();
        $companyUser = new CompanyUsers([
            'id' => $command->uuid()->toString(),
            'company_id' => 1,
            'name' => $command->getName()->value(),
            'email' => $command->getEmail()->value(),
            'phone' => $phone ? $phone->value() : null,
        ]);

        try {
            Requirements::fulfilled(new Entity($companyUser->email, $numberOfUsers));

            if ($companyUser->save()) {
                $this->eventsManager->fire('CompanyUser:Created', $this, [
                    'entity' => $companyUser,
                ]);
            } else {
                $this->eventsManager->fire('CompanyUser:SaveFailed', $this, [
                    'messages' => $companyUser->getMessages(),
                ]);
            }
        } catch (RequirementsNotMetException $exception) {
            $this->eventsManager->fire('CompanyUser:SaveFailed', $this, [
                'messages' => [$exception->getMessage()],
            ]);
        }
    }
}
