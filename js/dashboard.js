/**
 * @file
 * Dashboard UI behaviors.
 */

(function ($, window, Drupal) {

  'use strict';

  /**
   * Dashboard icons generator.
   *
   * @type {Drupal~behavior}
   *
   * @prop {Drupal~behaviorAttach} attach
   *   Attaches the behavior for the dashboard icons.
   */
  Drupal.behaviors.dashboardIcons = {
    attach: function () {
      console.log('Hello world!');
    }
  };

})(jQuery, window, Drupal);
