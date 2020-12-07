<?php

namespace lantongxue\nohup;

class Process
{
    protected $pid = -1;

    public function __construct($pid)
    {
        $this->pid = $pid;
    }

    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Check the process is already running via pid
     * @return bool
     */
    public function isRunning()
    {
        if (OS::isWin()) {
            $cmd = "wmic process get processid | findstr \"{$this->pid}\"";
            $res = array_filter(explode(" ", shell_exec($cmd)));
            return count($res) > 0 && $this->pid == reset($res);
        } else {
            return !!posix_getsid($this->pid);
        }
    }

    /**
     * Stop the process via pid
     */
    public function stop()
    {
        if (OS::isWin()) {
            $cmd = "taskkill /pid {$this->pid} -t -f";
        } else {
            $cmd = "kill -9 {$this->pid}";
        }
        shell_exec($cmd);
    }

    public static function loadFromPid($pid)
    {
        return new static($pid);
    }
}
