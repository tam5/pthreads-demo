<?php

class Task extends Threaded
{
    private $value;
    private $data;

    public function __construct(int $i, $data)
    {
        $this->value = $i;
        $this->data = $data;
    }

    public function run()
    {
        usleep(550000);
        echo "Task: {$this->value}\n";
    }
}

$pool = new Pool(4);

$data = [
        'thing' => 'bar',
        'thing1' => 'bar',
        'thing2' => 'bar',
        'thing3' => 'bar',
        'thing4' => 'bar',
        'thing5' => 'bar',
        'thing6' => 'bar',
];

for ($i = 0; $i < 20; ++$i) {
    $pool->submit(new Task($i, $data));
}

while ($pool->collect());

$pool->shutdown();

echo "Peak Usage: " . memory_get_peak_usage()  ."\n";
