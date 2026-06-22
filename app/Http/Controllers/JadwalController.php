<?php

namespace App\Http\Controllers;

use App\Models\JadwalJebol;
use Illuminate\Http\Request;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));
        
        $currentDate = Carbon::createFromDate($year, $month, 1);
        $monthName = $currentDate->translatedFormat('F Y');
        
        // Calendar Grid Calculation
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        
        $startOfCalendar = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);
        
        $calendar = [];
        $date = $startOfCalendar->copy();
        while ($date->lte($endOfCalendar)) {
            $calendar[] = [
                'date' => $date->copy(),
                'isCurrentMonth' => $date->month == $month,
                'isToday' => $date->isToday(),
            ];
            $date->addDay();
        }

        // Fetch activities for the current month view (including leading/trailing days)
        $activities = JadwalJebol::whereBetween('tanggal_pelayanan', [$startOfCalendar, $endOfCalendar])
                            ->get()
                            ->groupBy(function($item) {
                                return $item->tanggal_pelayanan->format('Y-m-d');
                            });

        // Upcoming activities for sidebar
        $upcoming = JadwalJebol::where('tanggal_pelayanan', '>=', Carbon::today())
                          ->orderBy('tanggal_pelayanan', 'asc')
                          ->take(5)
                          ->get();

        $nearest = $upcoming->first();

        return view('admin.jadwal', compact('activities', 'monthName', 'upcoming', 'currentDate', 'calendar', 'nearest'));
    }

    public function create()
    {
        return view('admin.jadwal-baru');
    }

    public function store(Request $request)
    {
        if ($request->jenis_lokasi === 'Masyarakat') {
            $request->merge(['jenis_lokasi' => 'Kecamatan']);
        }

        $validated = $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_pelayanan' => 'required|date',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'petugas' => 'nullable|string',
            'jenis_layanan' => 'required|string',
            'jenis_lokasi' => 'required|string',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('jadwal_foto', 'public');
        }

        JadwalJebol::create($validated);

        return redirect()->route('admin.jadwal')->with('success', 'Jadwal baru berhasil ditambahkan!');
    }
    public function publicIndex(Request $request)
    {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));
        
        $currentDate = Carbon::createFromDate($year, $month, 1);
        $monthName = $currentDate->translatedFormat('F Y');
        
        // Calendar Grid Calculation
        $startOfMonth = $currentDate->copy()->startOfMonth();
        $endOfMonth = $currentDate->copy()->endOfMonth();
        
        $startOfCalendar = $startOfMonth->copy()->startOfWeek(Carbon::SUNDAY);
        $endOfCalendar = $endOfMonth->copy()->endOfWeek(Carbon::SATURDAY);
        
        $calendar = [];
        $date = $startOfCalendar->copy();
        while ($date->lte($endOfCalendar)) {
            $calendar[] = [
                'date' => $date->copy(),
                'isCurrentMonth' => $date->month == $month,
                'isToday' => $date->isToday(),
            ];
            $date->addDay();
        }

        // Determine which view to return based on route name
        $isMasyarakat = request()->routeIs('masyarakat.jadwal');
        $view = $isMasyarakat ? 'masyarakat.jadwal' : 'pengunjung.jadwal';

        $activities = JadwalJebol::whereBetween('tanggal_pelayanan', [$startOfCalendar, $endOfCalendar])
                            ->get()
                            ->groupBy(function($item) {
                                return $item->tanggal_pelayanan->format('Y-m-d');
                            });

        $selectedDate = request('date');

        if ($selectedDate) {
            $upcoming = JadwalJebol::whereDate('tanggal_pelayanan', $selectedDate)
                              ->orderBy('jam_mulai', 'asc')
                              ->get();
            $nearest = $upcoming->first();
        } else {
            $upcoming = JadwalJebol::where('tanggal_pelayanan', '>=', Carbon::today())
                              ->orderBy('tanggal_pelayanan', 'asc')
                              ->take(5)
                              ->get();
            $nearest = $upcoming->first();
        }

        return view($view, compact('activities', 'monthName', 'upcoming', 'currentDate', 'calendar', 'nearest', 'selectedDate'));
    }


}
