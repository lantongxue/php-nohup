php-nohup
===

这是一个用来执行后台任务的库,可以返回后台任务的真是 pid,因此可以得到后台进程的运行状态,并且随时可以停止它 

这是可跨平台的库, 支持以下系统:   
- Windows
- Linux
- Mac osx

文档语言  
- [English](README.md)
- 简体中文

安装
---

可以通过 composer 来安装

`compoer require lantongxue/nohup`

如何使用
---

#### 开启一个后台进程

**你看,非常简单!**

```php
use lantongxue\nohup\Nohup;

$process = Nohup::run('sleep 5');
```
这个进程将会在后台运行5秒钟.

不过,你可以随时停止它:

```php
//...
$process->stop();
```
他已经被 kill 了!

可以 通过此方法得到进程的 pid: `$process->getPid()`, 可以返回真正的 pid 不论是 windows 系统还是 *nix 系统

也可以通过此方法查看进程的实时状态 `$process->isRunning()`:
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



#### 通过一直的 pid（$pid） 来创建一个 process 对象

```php
use lantongxue\nohup\Process;

$process = Process::loadFromPid($pid);  
//or
$process = new Process($pid); 

if ($process->isRunning()) {
    $process->stop();
}
```
####  方法:
`Nohup::run($commandLine, $outputFile, $errorFile)`  
- `$commandLine`: string, 将要执行的命令.  
- `$outputFile`: string, 保存输出内容的文件路径.  
- `$errlogFile`: string, 保存错误信息的文件路径.  