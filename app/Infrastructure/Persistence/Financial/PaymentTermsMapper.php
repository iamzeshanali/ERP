<?php declare(strict_types = 1);

namespace App\Infrastructure\Persistence\Financial;

use Dms\Core\Persistence\Db\Mapping\Definition\MapperDefinition;
use Dms\Core\Persistence\Db\Mapping\EntityMapper;
use App\Domain\Entities\Financial\PaymentTerms;
use Dms\Common\Structure\Web\Persistence\HtmlMapper;

/**
 * The App\Domain\Entities\Financial\PaymentTerms entity mapper.
 */
class PaymentTermsMapper extends EntityMapper
{
    /**
     * Defines the entity mapper
     *
     * @param MapperDefinition $map
     *
     * @return void
     */
    protected function define(MapperDefinition $map)
    {
        $map->type(PaymentTerms::class);
        $map->toTable('payment_terms');

        $map->idToPrimaryKey('id');

        $map->property(PaymentTerms::CODE)->to('code')->nullable()->asVarchar(255);

        $map->embedded(PaymentTerms::TERM_DESCRIPTION)
            ->withIssetColumn('term_description')
            ->using(new HtmlMapper('term_description'));

        $map->enum(PaymentTerms::STATUS)->to('status')->usingValuesFromConstants();


    }
}