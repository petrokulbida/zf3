<?php
/**
 * SignInForm
 *
 * @link https://github.com/fanatov37/zf3.git for the canonical source repository
 * @copyright Copyright (c)
 * @license YouFold (c)
 * @author VladFanatov
 * @package User
 */
namespace User\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class SignInForm extends Form implements InputFilterProviderInterface
{
    /**
     * SignInForm constructor.
     */
    public function __construct()
    {
        parent::__construct('sign-in-form');

        $this->add([
            'name' => 'email',
            'type' => 'Text',
            'options' => [
                'label' => 'Email'
            ],
            'attributes' => [
                'maxlength' => '255',
                'class' => 'form-control',
                'placeholder' => 'Email'
            ]
        ]);

        $this->add([
            'name' => 'password',
            'type' => 'Password',
            'options' => [
                'label' => 'Password',
            ],
            'attributes' => [
                'maxlength' => '255',
                'class' => 'form-control',
                'placeholder' => 'Password'
            ],
        ]);

        $this->add([
            'name' => 'csrf',
            'type' => 'Csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 3600
                ]
            ]
        ]);

        $this->add([
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => [
                'class' => 'btn btn-primary btn-block btn-flat',
                'value' => 'Sign in'
            ],
        ]);
    }

    /**
     * Define InputFilterSpecifications
     *
     * @access public
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return [

            'email' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags']
                ],
                'properties' => [
                    'required' => true
                ],
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                        'options' => [
                            'domain' => true
                        ]
                    ],
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'max' => 255
                        ]
                    ]
                ]
            ],

            'password' => [
                'required' => true,
                'filters' => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 3,
                            'max' => 255
                        ]
                    ]
                ]
            ]
        ];
    }
}