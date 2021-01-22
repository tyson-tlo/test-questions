<?php

/* -----------------------------------------------------------------------------
2. Priority Queue Data Structure 
-----------------------------------------------------------------------------
Implement a Priority Queue in PHP.  A Priority Queue extends the Queue
abstract data type by returning entries with the highest priority first.  
   
It should contain the following methods:

	enqueue(string value, int priority) : void
		Places an item into the priority queue with the specified 
		priority

	dequeue() : string
		Returns the next item in the queue with the highest priority,
		if two or more items contain the same priority, the items 
		should be returned in FIFO order

	isEmpty() : bool
		Returns true if the queue is empty
 
Sample Usage:

> queue = new PriorityQueue();
> queue.enqueue("a", 1)
> queue.enqueue("b", 1)
> queue.enqueue("c", 10)
> queue.enqueue("d", 3)

> print queue.dequeue() // "c"
> print queue.dequeue() // "d"
> print queue.dequeue() // "a"
> print queue.dequeue() // "b"
 */



class PriorityQueue
{   
    private $queue = [];

    public function enqueue(string $value, int $priority)
    {
        $entry = [$value, $priority];

        $q_count = count($this->queue);
        // If array is empty, then append to empty array
        if (!$q_count) {
            $this->queue[] = $entry;
            return;
        }
        
        // loop through queue to see where entry should be inserted
        for ($i = 0; $i < $q_count; $i++) {
            // If we're at the end of the queue insert entry 
            if ($q_count === $i + 1) {
                $this->queue[] = $entry;
                break;
            }
            // If priority is greater than priority at index then add it
            if ($priority > $this->queue[$i][1]) {
                if ($i === 0) {
                    // if index is at position zero then add it to beginning of array
                    array_unshift($this->queue, $entry);
                } else {
                    // else splice item into queue
                    array_splice($this->queue, $i, 0, array($entry));
                }
                
                break;
            }
        }

        return;
    }

    /**
     * Returns the first item in the queue and removes it from the object
     */
    public function dequeue()
    {
        $nextItemInQueue = $this->queue[0][0];
        array_shift($this->queue);
        return $nextItemInQueue;
    }

    public function isEmpty()
    {
        return count($this->queue) === 0;
    }

    public function prettyPrintQueue() {
        foreach($this->queue as $q) {
            echo $q[0] . ": " . $q[1] . "\n";
        }
    }
}

$queue = new PriorityQueue();

$queue->enqueue('aa', 1);
$queue->enqueue('ab', 1);
$queue->enqueue('ac', 3);
$queue->enqueue('ad', 10);
// Additional enqueue's ran to test for possible issues when inserting into queue
$queue->enqueue('ae', 1);
$queue->enqueue('af', 3);
$queue->enqueue('ag', 9);
// $queue->prettyPrintQueue();

print $queue->dequeue() . "\n";
print $queue->dequeue() . "\n";
print $queue->dequeue() . "\n";
print $queue->dequeue() . "\n";
print $queue->dequeue() . "\n";
print $queue->dequeue() . "\n";
print $queue->dequeue() . "\n";
// $queue->prettyPrintQueue();
