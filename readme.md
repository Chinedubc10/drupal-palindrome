# Palindrome Checker — Drupal 11 Custom Module

This module is created for Task 2: A simple custom Drupal 11 module that checks if a word or phrase is a palindrome.

---

## Features

- Simple Drupal 11 custom module
- Provides a form to enter text
- Checks if the text is a palindrome or not
- Shows result as a message
- Includes hook_help()

---

## Module Structure

palindrome_check/
├── palindrome_check.info.yml
├── palindrome_check.module
├── palindrome_check.routing.yml
└── src/
├── Form/
│ └── PalindromeForm.php
└── Controller/
└── PalindromeController.php

---

## Installation

1. Copy the module folder into:
   web/modules/custom/palindrome_check

2. Enable the module at:
   /admin/modules

3. Access the palindrome form at:
   /palindrome

---

## How It Works

1. User enters text
2. Spaces are removed and text is lowercased
3. Text is compared forward and backward
4. Displays whether it is a palindrome

Example:

| Input   | Result           |
| ------- | ---------------- |
| racecar | Palindrome       |
| hello   | Not a palindrome |

---

## Requirements Completed

- Custom module created
- Palindrome logic works
- hook_help() included
- Fully functional
