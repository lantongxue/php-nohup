<?php

namespace lantongxue\nohup;


class Command
{
    protected $commandline;
    protected $outputFile;
    protected $errLogFile;


    public function __construct($commandLine, $outputFile, $errlogFile)
    {
        $this->commandline = $commandLine;
        $this->setOutputFile($outputFile);
        $this->setErrlogFile($errlogFile);
    }

    public function __toString()
    {
        return $this->commandline;
    }

    /**
     * @param string $outputFile
     */
    public function setOutputFile($outputFile)
    {
        $this->outputFile = (string) $outputFile;
    }

    public function getOutputFile()
    {
        return $this->outputFile;
    }

    /**
     * @param string $errlog
     */
    public function setErrlogFile($errlogFile)
    {
        $this->errLogFile = (string) $errlogFile;
    }

    public function getErrlogFile()
    {
        return $this->errLogFile;
    }

    public function getCommandLine()
    {
        if (OS::isWin()) {
            $command = "START /b " . $this->commandline;
        } else {
            //$command = sprintf('nohup %s 2>&1 &', $this->commandline);
            $command = '{(' . $this->commandline . ') <&3 3<&- 3>/dev/null & } 3<&0;';
            $command .= 'pid=$!;echo $pid >&3; wait $pid; code=$?; echo $code >&3;exit $code';
        }
        return $command;
    }

    public function nohup()
    {
        return Nohup::runCommand($this);
    }
}
