<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Validator;

class CreateTaskRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'name'           => 'required|min:3',
	      'type'           => 'required|exists:task_types,id',
//	      'due_date'       => 'date_format:"F, d Y g:i a"|required_without:recurring_date',
	      'due_date'       => 'date|required_without:recurring_date',
	      'recurring_date' => 'empty_when:due_date',
	      'priority'       => 'required|integer',
          'image'          => 'image',
	      'task_members'   => 'members_exists',
	      'coordinates'    => 'coordinates',
	      'description'    => 'min:3',
	      'notes'          => 'min:3'
        ];
    }

	protected function getValidatorInstance()
	{
		$validator = parent::getValidatorInstance();

		$validator->after(function () use ($validator) {
			$input = $this->all();
//	dd($input);
			$this->validateTaskMember($this, $validator);

			$this->validateSubtasks($input['subtasks'], $validator);
		});

		return $validator;
	}

	private $subtaskRules = [
		'name'        => 'required|min:3',
		'image'       => 'image',
		'description' => 'min:3'
	];

	private function validateSubtasks($subtasks, $validator)
	{

		/* Validate subtask only if subtask name is filled */
		foreach ( $subtasks as $index => $task ) {
			$this->addSubtaskError($validator, $task, $index);
		}
	}

	/**
	 * @param $instance
	 * @param $validator
	 */
	private function validateTaskMember($instance, $validator)
	{
		if ( !$instance->has('task_members') ) {
			$validator->errors()->add('task_members', 'Task must be assigned.');
		}
	}

	/**
	 * @param $validator
	 * @param $task
	 * @param $index
	 */
	private function addSubtaskError($validator, $task, $index)
	{
		if ( $task['name'] ) {
			$localValidator = Validator::make($task, $this->subtaskRules);

			if ( $localValidator->fails() ) {

				$errors = $localValidator->errors();

				if ( $errors->has('name') ) {
					$validator->errors()->add("subtasks[$index][name]", $errors->first('name'));
				}

				if ( $errors->has('image') ) {
					$validator->errors()->add("subtasks[$index][image]", $errors->first('image'));
				}

				if ( $errors->has('description') ) {
					$validator->errors()->add("subtasks[$index][description]", $errors->first('description'));
				}

			}
		}
	}


}
