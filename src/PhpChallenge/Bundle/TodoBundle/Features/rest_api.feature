@api
Feature: Todo List REST API
  In order to manage a todo list
  As a user of the application
  I need to be able to manage my todo list

  Background:
    #Given empty database

  @authentication
  Scenario: Retrieve todo list without being authenticated
    Given I send a GET request to "/api/list.json"
    And print last JSON response
