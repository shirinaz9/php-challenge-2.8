@api
Feature: Todo List REST API
  In order to manage a todo list
  As a user of the application
  I need to be able to manage my todo list

  Background:
    Given empty database

  @authentication
  Scenario: Retrieve todo list without being authenticated should fail
    Given I send a GET request to "/api/list.json"
    Then the JSON node "message" should be equal to "An authentication exception occurred."
    And the response status code should be 403
    And print last JSON response

  @authentication
  Scenario: Retrieve todo list with invalid token should fail
    Given I am authenticated as user "test user" with token "abc123"
    And I set header "HTTP_X-AUTH-TOKEN" to "aacas"
    When I send a GET request to "/api/list.json"
    Then the JSON node "message" should be equal to "An authentication exception occurred."
    And the response status code should be 403
    And print last JSON response

  @authentication @success
  Scenario: Retrieve todo list while being authenticated should succeed
    Given I am authenticated as user "test user" with token "abc123"
    And I set header "HTTP_X-AUTH-TOKEN" to "abc123"
    When I send "GET" request to "/api/list.json"
    And print last JSON response
    And the JSON node "id" should exist
    And the JSON node "items" should exist
    And the JSON node "items" should have 0 elements

  Scenario: Create todo list item with invalid data should fail
    Given I am authenticated as user "test user" with token "abc123"
    And I set header "HTTP_X-AUTH-TOKEN" to "abc123"
    And I set header "CONTENT_TYPE" to "application/json"
    When I send "POST" request to "/api/list/item.json"
    """
      {
        "description": ""
      }
    """
    And print last JSON response
    And the JSON node "code" should exist
    And the JSON node "code" should be equal to "400"
    And the JSON node "message" should exist
    And the JSON node "message" should be equal to "Validation Failed"
    And the JSON node "errors" should exist
    And the JSON node "errors.children.description" should exist
    And the JSON node "errors.children.status" should exist

  Scenario: Create todo list item while being authenticated should succeed
    Given I am authenticated as user "test user" with token "abc123"
    And I set header "HTTP_X-AUTH-TOKEN" to "abc123"
    And I set header "CONTENT_TYPE" to "application/json"
    When I send "POST" request to "/api/list/item.json"
    """
      {
        "description": "test item",
        "status": "active"
      }
    """
    And print last JSON response
    And the JSON node "id" should exist
    And the JSON node "status" should exist
    And the JSON node "status" should be equal to "active"
    And the JSON node "description" should exist
    And the JSON node "description" should be equal to "test item"
    And the JSON node "list" should exist
