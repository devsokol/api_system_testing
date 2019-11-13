<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tickets Model
 *
 * @method \App\Model\Entity\Ticket get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ticket newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ticket[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ticket|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ticket|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ticket patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ticket[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ticket findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TicketsTable extends Table
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

        $this->setTable('tickets');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->belongsTo('Specialty', [
            'foreignKey' => 'id_specialty',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Courses', [
            'foreignKey' => 'id_course',
            'joinType' => 'INNER'
        ]);

        $this->hasMany('Questions', [
            'foreignKey' => 'id_ticket',
            'joinType' => 'INNER'
        ]);

        $this->addBehavior('Timestamp');
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
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmpty('title', 'Заголовок не може бути пустим!')
            ->allowEmptyString('title', false);

        $validator
            ->integer('time_of_passing')
            ->requirePresence('time_of_passing', 'create')
            ->notEmpty('time_of_passing', 'Час проходження не може бути пустим!')
            ->allowEmptyString('time_of_passing', false);

        $validator
            ->integer('count_question')
            ->notEmpty('count_question', 'Кількість питань не може бути пустим!')
            ->requirePresence('count_question', 'create')
            ->allowEmptyString('count_question', false);

        $validator
            ->integer('id_specialty')
            ->requirePresence('id_specialty', 'create')
            ->allowEmptyString('id_specialty', false);

        $validator
            ->integer('id_course')
            ->allowEmptyString('id_course', false);

        return $validator;
    }
}
