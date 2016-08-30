<?php

namespace ultimadark\Logger;

/**
 * Class to log what happens.
 *
 */
class CLog {

  /**
   * Properties
   *
   */
  private $timestamp = array();
  private $pos = 0;
  private $precision;

  /**
   * Constructor
   *
   * @param int $precision the precision of the rounding when presenting results.
   */
  public function __construct($precision = 4) {
    $this->precision = $precision;
  }

  /**
   * Timestamp, log a event with a time.
   *
   * @param string $domain is the module or class.
   * @param string $where a more specific place in the domain.
   * @param string $comment on the timestamp.
   *
   */
  public function Timestamp($domain, $where, $comment=null) {
    $now = microtime(true);
    $this->timestamp[] = array(
      'domain'  => $domain,
      'where'   => $where,
      'comment' => $comment,
      'when'    => $now,
      'memory'  => memory_get_usage(true),
      'duration'=> 0,
    );

    if($this->pos > 0) {
      $this->timestamp[$this->pos - 1]['memory-peak'] = memory_get_peak_usage(true);
      $this->timestamp[$this->pos - 1]['duration']    = $now - $this->timestamp[$this->pos - 1]['when'];
    }
    
    $this->pos++;
  }

  /**
   * Print all timestamp to a table.
   *
   * @return string with a html-table to display all timestamps.
   *
   */
  public function TimestampAsTable() {

    // Set up the table
    $first = $this->timestamp[0]['when'];
    $last = $this->timestamp[count($this->timestamp) - 1]['when'];
    $html = "<table class=table><caption>Timestamps</caption><tr><th>Domain</th><th>Where</th><th>When (sec)</th><th>Duration (sec)</th><th>Percent</th><th>Memory (MB)</th><th>Memory peak (MB)</th><th>Comment</th></tr>";
    $right = ' style="text-align: right;"';
    $total = array('domain' => array(), 'where' => array());

    $totalDuration = $last - $first;

    // Create the main table
    foreach($this->timestamp as $val) {
      $when     = $val['when'] - $first;
      $duration = round($val['duration'], $this->precision);
      $percent  = round(($when) / $totalDuration * 100);
      $memory   = round($val['memory'] / 1024 / 1024, 2);
      $peak     = isset($val['memory-peak']) ? round($val['memory-peak'] / 1024 / 1024, 2): 0;
      $when     = round($when, $this->precision);
      $html .= "<tr><td>{$val['domain']}</td><td>{$val['where']}</td><td{$right}>{$when}</td><td{$right}>{$duration}</td><td{$right}>{$percent}</td><td{$right}>{$memory}</td><td{$right}>{$peak}</td><td>{$val['comment']}</td></tr>";
      @$total['domain'][$val['domain']] += $duration;
      @$total['where'][$val['where']] += $duration;
    }

    $html .= "</table><table class=table><caption>Duration per domain</caption><tr><th>Domain</th><th>Duration</th><th>Percent</th></tr>";
    
    
    // Create the table grouped by domain   
    arsort($total['domain']);
    
    foreach($total['domain'] as $key => $val) {
      if ($totalDuration != 0) {
        $percent = round($val / $totalDuration * 100, 1);
      }    
      else {
        $percent = 100;
      }  

      $html .= "<tr><td>{$key}</td><td>{$val}</td><td>{$percent}</td></tr>";
    }

    $html .= "</table><table class=table><caption>Duration per area</caption><tr><th>Area</th><th>Duration</th><th>Percent</th></tr>";
    
    // Create the table grouped by area
    arsort($total['where']);

    foreach($total['where'] as $key => $val) {
      if ($totalDuration != 0) {
        $percent = round($val / $totalDuration * 100, 1);
      }    
      else {
        $percent = 100;
      }  
      $html .= "<tr><td>{$key}</td><td>{$val}</td><td>{$percent}</td></tr>";
    }

    $html .= "</table>";

    return $html;
  }

  /**
   * Returns load time of the page
   *
   * @return The page load time.
   *
   */
  public function PageLoadTime() {

    $first = $this->timestamp[0]['when'];
    $last = $this->timestamp[count($this->timestamp) - 1]['when'];
    $loadtime = round($last - $first, 3);
    return $loadtime;
  }

  /**
   * Get the memory peak.
   *
   * @return The memory peak.
   *
   */
  public function MemoryPeak() {

    $peek = round(memory_get_peak_usage(true) / 1024 / 1024, 2);
    return $peek;
  }
}