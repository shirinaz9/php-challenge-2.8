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
    And I add "X-AUTH-TOKEN" header equal to "aacas"
    When I send a GET request to "/api/list.json"
    Then the JSON node "message" should be equal to "An authentication exception occurred."
    And the response status code should be 403
    And print last JSON response

  @authentication @success
  Scenario: Retrieve todo list while being authenticated should succeed
    Given I am authenticated as user "test user" with token "abc123"
    And I set header "X-AUTH-TOKEN" to "abc123"
    When I send "GET" request to "/api/list.json"
    And print last JSON response
    And the JSON node "id" should exist
    And the JSON node "items" should exist
    And the JSON node "items" should have 0 elements

#  Scenario: Create todo list item while being authenticated should succeed
#    Given I am authenticated as user "test user" with token "abc123"
#    And I set header "X-AUTH-TOKEN" to "abc123"
#    When I send "POST" request to "/api/list/item.json"
#    """
#      {
#
#      }
#    """
#    And print last JSON response
#    And the JSON node "id" should exist
#    And the JSON node "items" should exist
#    And the JSON node "items" should have 0 elements
