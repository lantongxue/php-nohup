php-nohup
===

A library to run a command in the background, it will return the process's pid, and get it's is running status anytime in the another process, and can be stoped anytime.  
 

suport these system: 
- Windows
- Linux
- Mac osx

Document Language  
- English
- [简体中文](README_zh.md)

Installation
---

Install via composer:  

`compoer require lantongxue/nohup`

Usage
---

#### Run a script background

**Look, so easy!**

```php
use lantongxue\nohup\Nohup;

$process = Nohup::run('sleep 5');
```
It will be running in the background for 5 seconds.

But, it can be stoped any time:

```php
//...
$process->stop();
```
It stoped now!

Get the pid : `$process->getPid()`, It will return the real pid in both window and *inx system

Get it's running status with the function `$process->isRunning()`:
```php
use lantongxue\nohup\Nohup;

$process = Nohup::run('sleep 5');
while ($process->isRunning()) {
    echo '.';
    sleep(1);
}
echo "Done.\n";

```
*output*: `.....Done.`   



#### Create process from known pid ($pid)

```php
use lantongxue\nohup\Process;

$process = Process::loadFromPid($pid);  
//or
$process = new Process($pid); 

if ($process->isRunning()) {
    $process->stop();
}
```
#### Method:
`Nohup::run($commandLine, $outputFile, $errorFile)`  
- `$commandLine`: string, the command will be run.  
- `$outputFile`: string, the file path where to save output content.  
- `$errlogFile`: string, the file path where to save error message.  