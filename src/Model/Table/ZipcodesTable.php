<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Zipcodes Model
 *
 * @method \App\Model\Entity\Zipcode get($primaryKey, $options = [])
 * @method \App\Model\Entity\Zipcode newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Zipcode[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Zipcode|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Zipcode|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Zipcode patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Zipcode[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Zipcode findOrCreate($search, callable $callback = null, $options = [])
 */
class ZipcodesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('zipcodes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->integer('jis_code')
            ->requirePresence('jis_code', 'create')
            ->notEmpty('jis_code');

        $validator
            ->integer('zipcode_old')
            ->requirePresence('zipcode_old', 'create')
            ->notEmpty('zipcode_old');

        $validator
            ->integer('zipcode')
            ->requirePresence('zipcode', 'create')
            ->notEmpty('zipcode');

        $validator
            ->scalar('prefecture_mb')
            ->maxLength('prefecture_mb', 64)
            ->requirePresence('prefecture_mb', 'create')
            ->notEmpty('prefecture_mb');

        $validator
            ->scalar('city_mb')
            ->maxLength('city_mb', 128)
            ->requirePresence('city_mb', 'create')
            ->notEmpty('city_mb');

        $validator
            ->scalar('town_mb')
            ->maxLength('town_mb', 128)
            ->requirePresence('town_mb', 'create')
            ->notEmpty('town_mb');

        $validator
            ->scalar('prefecture')
            ->maxLength('prefecture', 64)
            ->requirePresence('prefecture', 'create')
            ->notEmpty('prefecture');

        $validator
            ->scalar('city')
            ->maxLength('city', 128)
            ->requirePresence('city', 'create')
            ->notEmpty('city');

        $validator
            ->scalar('town')
            ->maxLength('town', 128)
            ->requirePresence('town', 'create')
            ->notEmpty('town');

        $validator
            ->boolean('has_multi_zipcode')
            ->requirePresence('has_multi_zipcode', 'create')
            ->notEmpty('has_multi_zipcode');

        $validator
            ->boolean('is_each_AZA')
            ->requirePresence('is_each_AZA', 'create')
            ->notEmpty('is_each_AZA');

        $validator
            ->boolean('has_CHOU')
            ->requirePresence('has_CHOU', 'create')
            ->notEmpty('has_CHOU');

        $validator
            ->boolean('is_multi_zipcode')
            ->requirePresence('is_multi_zipcode', 'create')
            ->notEmpty('is_multi_zipcode');

        $validator
            ->integer('update_reason')
            ->requirePresence('update_reason', 'create')
            ->notEmpty('update_reason');

        $validator
            ->integer('change_reason')
            ->requirePresence('change_reason', 'create')
            ->notEmpty('change_reason');

        return $validator;
    }
}
