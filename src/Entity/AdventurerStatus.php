<?php

namespace App\Entity;

enum AdventurerStatus: string
{
    case AVAILABLE = 'available';
    case SLEEPING = 'sleeping';
    case SICK = 'sick';
    case READY = 'ready';
    case WORKING = 'working';
    case EATING = 'eating';
    case POISONED = 'poisoned';
    case UNAVAILABLE = 'unavailable';
}
