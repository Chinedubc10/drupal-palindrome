<?php

namespace Drupal\palindrome_check\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

final class PalindromeForm extends FormBase {

  public function getFormId(): string {
    return 'palindrome_check_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['input'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Input'),
      '#required' => TRUE,
      '#attributes' => ['placeholder' => $this->t('Type text to check')],
    ];

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Check'),
      '#button_type' => 'primary',
    ];

    if ($form_state->has('palindrome_result')) {
      $is_pal = (bool) $form_state->get('palindrome_result');
      $this->messenger()->addStatus($is_pal ? $this->t('It is a palindrome.') : $this->t('Not a palindrome.'));
      $form['result'] = ['#type' => 'status_messages'];
    }

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state): void {
    $val = trim((string) $form_state->getValue('input'));
    if ($val === '') {
      $form_state->setErrorByName('input', $this->t('Please enter some text.'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $raw = (string) $form_state->getValue('input');
    $norm = mb_strtolower(preg_replace('~[^\p{L}\p{N}]+~u', '', $raw));
    $is_pal = ($norm !== '') && ($norm === $this->mb_strrev($norm));
    $form_state->set('palindrome_result', $is_pal);
    $form_state->setRebuild(TRUE);
  }

  private function mb_strrev(string $s): string {
    $out = '';
    for ($i = mb_strlen($s) - 1; $i >= 0; $i--) {
      $out .= mb_substr($s, $i, 1);
    }
    return $out;
  }
  
}

