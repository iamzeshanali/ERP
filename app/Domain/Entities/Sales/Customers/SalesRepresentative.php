<?php

namespace App\Domain\Entities\Sales\Customers;
 use Dms\Common\Structure\Money\Money;
 use Dms\Common\Structure\Web\EmailAddress;
 use Dms\Common\Structure\Web\Html;
 use Dms\Core\Model\Object\ClassDefinition;
 use Dms\Core\Model\Object\Entity;
 use Dms\Core\Model\Object\InvalidPropertyDefinitionException;
 use phpDocumentor\Reflection\Types\Boolean;

 class SalesRepresentative extends Entity {
     const CODE = 'code';
     const FIRST_NAME    = 'firstName';
     const LAST_NAME     = 'lastName';
     const COMMISSION = 'commission';
     const PHONE = 'phone';
     const CELL = 'cell';
     const EMAIL = 'email';
     const INACTIVE = 'inActive';

     /**
      * @var string
      */
     public $code;

     /**
      * @var string
      */
     public $firstName;
     /**
      * @var string
      */
     public $lastName;
     /**
      * @var float
      */
     public $commission;
     /**
      * @var string
      */
     public $phone;
     /**
      * @var string
      */
     public $cell;
     /**
      * @var string
      */
     public $email;
     /**
      * @var Boolean
      */
     public $inActive;

     /**
      * Defines the structure of this entity.
      *
      * @param ClassDefinition $class
      * @throws InvalidPropertyDefinitionException
      */
     protected function defineEntity(ClassDefinition $class)
     {
         $class->property($this->code)->asString();
         $class->property($this->firstName)->asString();
         $class->property($this->lastName)->nullable()->asString();
         $class->property($this->commission)->asFloat();
         $class->property($this->phone)->nullable()->asString();
         $class->property($this->cell)->nullable()->asString();
         $class->property($this->email)->nullable()->asObject(EmailAddress::class);
         $class->property($this->inActive)->asBool();
     }
     public function getName()
     {
         return $this->firstName . ' ' . $this->lastName;
     }
 }
