<?php

namespace App\Helpers;

use App\Models\History;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;

class Helpers
{
    public static function getHoursPassed(int $hours, array $options = []): string
    {
        $defaults = [
            'showHours' => true,     // Mostrar horas restantes
            'format' => 'full',      // full, short, decimal
            'locale' => 'es',        // es, en
            'precision' => 2,         // Decimales para formato decimal
        ];

        $options = array_merge($defaults, $options);

        // Cálculos básicos
        $days = floor($hours / 24);
        $remainingHours = $hours % 24;
        $decimalDays = $hours / 24;

        // Textos según idioma
        $texts = [
            'es' => [
                'day' => 'día',
                'days' => 'días',
                'hour' => 'hora',
                'hours' => 'horas',
            ],
            'en' => [
                'day' => 'day',
                'days' => 'days',
                'hour' => 'hour',
                'hours' => 'hours',
            ],
        ];

        $text = $texts[$options['locale']] ?? $texts['es'];

        // Generar resultado según formato
        return match ($options['format']) {
            'decimal' => number_format($decimalDays, $options['precision']).' '.($decimalDays === 1 ? $text['day'] : $text['days']),

            'short' => $days.'d'.($options['showHours'] && $remainingHours > 0 ? $remainingHours.'h' : ''),

            'full' => match (true) {
                $days === 0 => $hours.' '.($hours === 1 ? $text['hour'] : $text['hours']),
                $remainingHours === 0 => $days.' '.($days === 1 ? $text['day'] : $text['days']),
                $options['showHours'] => $days.' '.($days === 1 ? $text['day'] : $text['days']).' '.$remainingHours.' '.($remainingHours === 1 ? $text['hour'] : $text['hours']),
                default => $days.' '.($days === 1 ? $text['day'] : $text['days'])
            },
            default => $days.' '.($days === 1 ? $text['day'] : $text['days'])
        };
    }

    //metodo para obtener el nombre de la persona o sin asignar
    public static function getAssignedTask(int $task_id): string
    {

        $assigned = TaskUser::where('task_id', $task_id)->first();

        if ($assigned) {
            return $assigned->user->name;
        } else {
            return 'Unassigned';
        }

    }

    public static function getAssignedTaskById(int $task_id): string
    {

        $assigned = TaskUser::where('task_id', $task_id)->first();

        if ($assigned) {
            return $assigned->user->id;
        } else {
            return 0;
        }

    }

    public static function getCreditTotal(int $user_id): int
    {
        $credit = User::where('id', $user_id)->first();
        if ($credit) {
            return $credit->current_amount_total_credit;
        } else {
            return 0;
        }

    }

    public static function getCompletion(int $user_id): int
    {
        $CompletedCount = TaskUser::where('user_id', $user_id)
            ->join('tasks as t', 't.id', '=', 'tasks_users.task_id')
            ->join('status as s', 's.id', '=', 't.statu_id')
            ->where('s.id', 5)
            ->count();
        if ($CompletedCount) {
            return $CompletedCount;
        } else {
            return 0;
        }
    }

    public static function getCompletionAll(): int
    {
        $CompletedCount = TaskUser::join('tasks as t', 't.id', '=', 'tasks_users.task_id')
            ->join('status as s', 's.id', '=', 't.statu_id')
            ->where('s.id', 5)
            ->count();
        if ($CompletedCount) {
            return $CompletedCount;
        } else {
            return 0;
        }
    }

    public static function getPending(int $user_id): int
    {
        $PendingCount = TaskUser::where('user_id', $user_id)
            ->join('tasks as t', 't.id', '=', 'tasks_users.task_id')
            ->join('status as s', 's.id', '=', 't.statu_id')
            ->where('s.id', 3)
            ->count();
        if ($PendingCount) {
            return $PendingCount;
        } else {
            return 0;
        }
    }

    public static function getPendingAll(): int
    {
        $PendingCount = TaskUser::join('tasks as t', 't.id', '=', 'tasks_users.task_id')
            ->join('status as s', 's.id', '=', 't.statu_id')
            ->where('s.id', 3)
            ->count();
        if ($PendingCount) {
            return $PendingCount;
        } else {
            return 0;
        }
    }

    public static function getActive(int $user_id): int
    {
        $ActiveCount = TaskUser::where('user_id', $user_id)
            ->join('tasks as t', 't.id', '=', 'tasks_users.task_id')
            ->join('status as s', 's.id', '=', 't.statu_id')
            ->where('s.id', 1)
            ->count();
        if ($ActiveCount) {
            return $ActiveCount;
        } else {
            return 0;
        }
    }

    public static function getActiveAll(): int
    {
        $ActiveCount = TaskUser::join('tasks as t', 't.id', '=', 'tasks_users.task_id')
            ->join('status as s', 's.id', '=', 't.statu_id')
            ->where('s.id', 1)
            ->count();
        if ($ActiveCount) {
            return $ActiveCount;
        } else {
            return 0;
        }
    }

    public static function getCreditPayAll(int $value): int
    {
        $CreditCount = Task::where('credit_paid', $value)
            ->count();
        if ($CreditCount) {
            return $CreditCount;
        } else {
            return 0;
        }
    }

    //obtener el credito de un usuario
    public static function getCreditByUser(int $user_id): int
    {
        $user = User::where('id', $user_id)->first();
        if ($user) {
            return $user->current_amount_total_credit;
        } else {
            return 0;
        }
    }

    public static function getCreditPaid(int $credit_paid)
    {
        if (isset($credit_paid)) {
            if ($credit_paid > 0) {
                return '<span class="badge badge-success">Paid</span>';
            } else {
                return '<span class="badge badge-warning">Not Paid</span>';
            }
        }
    }

    public static function setHistory(int $TaskUser, int $statu_id, ?string $observation = null)
    {

        $History = History::create([
            'tasks_users_id' => $TaskUser,
            'statu_id' => $statu_id,
            'observation' => $observation,
        ]);
    }

    public static function setHistoryCredit(int $id, int $statu_id, ?string $observation = null)
    {

        $History = History::create([
            'tasks_users_id' => $id,
            'statu_id' => $statu_id,
            'observation' => $observation,
        ]);
    }
}
