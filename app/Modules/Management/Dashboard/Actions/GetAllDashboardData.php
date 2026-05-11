<?php

namespace App\Modules\Management\Dashboard\Actions;

use Illuminate\Support\Carbon;
use App\Modules\Management\UserManagement\User\Models\Model as User;
use App\Modules\Management\LiveCourseManagement\LiveCourse\Models\Model as LiveCourse;
use App\Modules\Management\LiveCourseManagement\LiveCourseEnrollment\Models\Model as LiveCourseEnrollment;
use App\Modules\Management\CourseManagement\Course\Models\Model as Course;
use App\Modules\Management\CourseManagement\CourseBatchStudent\Models\Model as CourseBatchStudent;
use App\Modules\Management\SeminerManagement\Seminer\Models\Model as Seminar;
use App\Modules\Management\CommunicationManagement\ContactMessage\Models\Model as ContactMessage;

class GetAllDashboardData
{
    public static function execute()
    {
        try {
            // ── Stats ──────────────────────────────────────────────────────
            $total_users               = User::count();
            $total_live_courses        = LiveCourse::count();
            $total_recorded_courses    = Course::count();
            $total_live_enrollments    = LiveCourseEnrollment::count();
            $total_recorded_enrollments= CourseBatchStudent::count();
            $live_revenue              = (float) LiveCourseEnrollment::where('payment_status', 'paid')->sum('amount_paid');
            $pending_live_enrollments  = LiveCourseEnrollment::where('payment_status', 'pending')->count();
            $total_seminars            = Seminar::count();
            $total_messages            = ContactMessage::count();

            // ── Monthly chart data (last 6 months) ─────────────────────────
            $months = collect(range(5, 0))->map(
                fn($i) => Carbon::now()->subMonths($i)->format('Y-m')
            );

            $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();

            $liveByMonth = LiveCourseEnrollment::selectRaw(
                    "DATE_FORMAT(enrolled_at, '%Y-%m') as month,
                     COUNT(*) as cnt,
                     SUM(amount_paid) as revenue"
                )
                ->where('enrolled_at', '>=', $sixMonthsAgo)
                ->groupBy('month')
                ->get()
                ->keyBy('month');

            $recordedByMonth = CourseBatchStudent::selectRaw(
                    "DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as cnt"
                )
                ->where('created_at', '>=', $sixMonthsAgo)
                ->groupBy('month')
                ->get()
                ->keyBy('month');

            $chart_labels           = $months->map(fn($m) => Carbon::createFromFormat('Y-m', $m)->format('M Y'))->values()->toArray();
            $chart_live_enrollments = $months->map(fn($m) => (int)($liveByMonth[$m]->cnt ?? 0))->values()->toArray();
            $chart_recorded_enrollments = $months->map(fn($m) => (int)($recordedByMonth[$m]->cnt ?? 0))->values()->toArray();
            $chart_revenue          = $months->map(fn($m) => (float)($liveByMonth[$m]->revenue ?? 0))->values()->toArray();

            // ── Recent live enrollments ────────────────────────────────────
            $recent_enrollments = LiveCourseEnrollment::with(['live_course_id', 'batch_id'])
                ->latest('enrolled_at')
                ->take(6)
                ->get()
                ->map(function ($e) {
                    $lc    = $e->getRelation('live_course_id');
                    $batch = $e->getRelation('batch_id');
                    return [
                        'id'             => $e->id,
                        'course'         => $lc?->title ?? 'N/A',
                        'batch'          => $batch?->batch_number ?? 'N/A',
                        'name'           => $e->student_info['name'] ?? 'N/A',
                        'phone'          => $e->student_info['phone'] ?? '',
                        'amount'         => $e->amount,
                        'amount_paid'    => $e->amount_paid,
                        'payment_status' => $e->payment_status,
                        'enrolled_at'    => $e->enrolled_at ? Carbon::parse($e->enrolled_at)->format('d M Y') : 'N/A',
                    ];
                });

            // ── Recent messages ────────────────────────────────────────────
            $recent_messages = ContactMessage::latest()->take(5)->get(['id', 'full_name', 'email', 'subject', 'message', 'created_at'])
                ->map(fn($m) => [
                    'id'         => $m->id,
                    'name'       => $m->full_name ?? 'N/A',
                    'email'      => $m->email ?? '',
                    'message'    => \Illuminate\Support\Str::limit($m->subject ?: $m->message, 60),
                    'created_at' => $m->created_at ? $m->created_at->format('d M Y') : 'N/A',
                ]);

            // ── GA measurement ID from settings ───────────────────────────
            $ga_measurement_id = setting('ga_measurement_id') ?: '';

            $data = [
                'total_users'                => $total_users,
                'total_live_courses'         => $total_live_courses,
                'total_recorded_courses'     => $total_recorded_courses,
                'total_live_enrollments'     => $total_live_enrollments,
                'total_recorded_enrollments' => $total_recorded_enrollments,
                'live_revenue'               => $live_revenue,
                'pending_live_enrollments'   => $pending_live_enrollments,
                'total_seminars'             => $total_seminars,
                'total_messages'             => $total_messages,
                'chart_labels'               => $chart_labels,
                'chart_live_enrollments'     => $chart_live_enrollments,
                'chart_recorded_enrollments' => $chart_recorded_enrollments,
                'chart_revenue'              => $chart_revenue,
                'recent_enrollments'         => $recent_enrollments,
                'recent_messages'            => $recent_messages,
                'ga_measurement_id'          => $ga_measurement_id,
            ];

            return entityResponse($data);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
