<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $os = new OrderStatus;
        $os->title='New';
        $os->background_color = 'bg-lime-400';
        $os->text_color = 'text-white';
        $os->save();
        $os = new OrderStatus;
        $os->title='In progress';
        $os->background_color = 'bg-cyan-500';
        $os->text_color = 'text-white';
        $os->save();
        $os = new OrderStatus;
        $os->title='Finished';
        $os->background_color = 'bg-neutral-200';
        $os->text_color = 'text-neutral-800';
        $os->save();
        $os = new OrderStatus;
        $os->title='Cancelled';
        $os->background_color = 'bg-rose-600';
        $os->text_color = 'text-white';
        $os->save();
    }
}
