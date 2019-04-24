<?php

namespace CqrsPlayground\Domain\Requirements\CompanyUser;

use CqrsPlayground\Domain\Requirements\RequirementsNotMetException;

class Requirements
{
    const EMAIL_DOMAIN_ALLOWED = 'firma.com';
    const MAX_USERS_ALLOWED = 10;

    public static function fulfilled(Entity $companyUser): bool
    {
        if (explode('@', $companyUser->getEmail())[1] !== Requirements::EMAIL_DOMAIN_ALLOWED) {
            throw new RequirementsNotMetException('Company users can only have emails that belong to company domain');
        }

        if ($companyUser->getTotalNumber() >= Requirements::MAX_USERS_ALLOWED) {
            throw new RequirementsNotMetException('Company users limit of maximum allowed users exceeded');
        }

        return true;
    }
}