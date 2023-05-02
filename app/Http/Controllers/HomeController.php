<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Schedule;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        $title = 'Kalender';
        $header = 'Kalender';

        $schedule = Schedule::where('is_active', 1)->first();
        if($schedule != null){
            $event = Event::where('tipe', $schedule->id)->orderBy('start_event', 'ASC')->get();
            foreach($event as $e){
                $e->start_event = Carbon::parse($schedule->tgl_mulai)->addDays($e->start_event)->format('Y-m-d');
                $e->end_event = Carbon::parse($schedule->tgl_mulai)->addDays(1 + $e->end_event)->format('Y-m-d');
            }
            
            return view('index', compact('title', 'header', 'event', 'schedule'));
        }

        $event = null;
        $schedule = null;

        return view('index', compact('title', 'header', 'event', 'schedule'));
    }

    public function tambah_rencana(Request $request) : RedirectResponse
    {
        $schedule = Schedule::where('is_active', 1)->first();

        $request->validate([
            'luas_lahan' => 'numeric|required',
            'bibit_jagung' => 'required',
            'pupuk' => 'required',
            'pupuk_sec' => 'required',
            'tgl_mulai' => 'date|required'
        ]);
        
        if($schedule != null){
            return redirect()->route('home')->with('error', 'Data gagal disimpan terdapat rencana yang masih aktif');
        }

        $data = $request->all();
        $data = $request->except(['_method', '_token']);
        
        $schedule = new Schedule;
        $schedule->luas_lahan = $data['luas_lahan'];
        $schedule->id_jagung = $data['bibit_jagung'];
        $schedule->id_pupuk = $data['pupuk'];
        $schedule->id_pupuk_sec = $data['pupuk_sec'];
        $schedule->tgl_mulai = $data['tgl_mulai'];
        $schedule->is_active = 1;
        $schedule->save();
        $id = $schedule->id;

        $pupuk = [];

        $nitrea = (int)$data['luas_lahan'] * 50;
        $nitrea2 = (int)$data['luas_lahan'] * 75;
        $yaramila = (int)$data['luas_lahan'] * 210;
        $nitrea2 = (int)$data['luas_lahan'] * 75;
        $phonska = (int)$data['luas_lahan'] * 100;
        $phonska2 = (int)$data['luas_lahan'] * 150;
        $phonska3 = (int)$data['luas_lahan'] * 200;
        $npk = (int)$data['luas_lahan'] * 150;
        $mahkota = (int)$data['luas_lahan'] * 100;
        $mahkota2 = (int)$data['luas_lahan'] * 70;
        $daun_buah = (int)$data['luas_lahan'] * 125;
        $daun_buah2 = (int)$data['luas_lahan'] * 50;

        if($data['pupuk'] == 1 && $data['pupuk_sec'] ==1) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk nitrea '. $nitrea .' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk yaramila '. $yaramila. 'kg',
                    'start_event' => 10,
                    'end_event' => 10,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk yaramila '. $yaramila .' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk nitrea '. $nitrea2 .' kg',
                    'start_event' => 30,
                    'end_event' => 30,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk nitrea '. $nitrea2 .' kg',
                    'start_event' => 37,
                    'end_event' => 37,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 1 && $data['pupuk_sec'] ==2) {   
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk nitrea ' . $nitrea . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska2 . ' kg',
                    'start_event' => 23,
                    'end_event' => 23,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk nitrea ' . $nitrea2 . ' kg',
                    'start_event' => 30,
                    'end_event' => 30,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska3 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk nitrea ' . $nitrea2 . ' kg',
                    'start_event' => 40,
                    'end_event' => 40,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 1 && $data['pupuk_sec'] ==3) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk nitrea ' . $nitrea . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk NPK ' . $npk . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk NPK ' . $npk . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk nitrea ' . $nitrea2 . ' kg',
                    'start_event' => 30,
                    'end_event' => 30,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk nitrea ' . $nitrea2 . ' kg',
                    'start_event' => 40,
                    'end_event' => 40,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 2 && $data['pupuk_sec'] ==1) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk yaramila ' . $yaramila . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk yaramila ' . $yaramila . ' kg',
                    'start_event' => 26,
                    'end_event' => 26,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota2 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 2 && $data['pupuk_sec'] ==2) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska2 . ' kg',
                    'start_event' => 22,
                    'end_event' => 22,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska3 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota2 . ' kg',
                    'start_event' => 40,
                    'end_event' => 40,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 2 && $data['pupuk_sec'] == 3) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk NPK ' . $npk . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk NPK ' . $npk . ' kg',
                    'start_event' => 26,
                    'end_event' => 26,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk mahkota ' . $mahkota2 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 3 && $data['pupuk_sec'] == 1) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk yaramila ' . $yaramila . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah . ' kg',
                    'start_event' => 22,
                    'end_event' => 22,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk yaramila ' . $yaramila . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah2 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 3 && $data['pupuk_sec'] == 2) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska2 . ' kg',
                    'start_event' => 22,
                    'end_event' => 22,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk phonska ' . $phonska3 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah2 . ' kg',
                    'start_event' => 35,
                    'end_event' => 35,
                    'tipe' => $id,
                ],
            ];
        }
        else if ($data['pupuk'] == 3 && $data['pupuk_sec'] == 3) {
            $pupuk = [
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah . ' kg',
                    'start_event' => 7,
                    'end_event' => 7,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk NPK ' . $npk . 'kg',
                    'start_event' => 12,
                    'end_event' => 12,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk NPK ' . $npk . ' kg',
                    'start_event' => 25,
                    'end_event' => 25,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah . ' kg',
                    'start_event' => 26,
                    'end_event' => 26,
                    'tipe' => $id,
                ],
                [
                    'title' => 'Pemberian pupuk daun buah ' . $daun_buah2 . ' kg',
                    'start_event' => 38,
                    'end_event' => 38,
                    'tipe' => $id,
                ],
            ];
        }

        $getEvent = $this->get_event($id, $pupuk);

        Event::insert($getEvent);
        
        return redirect()->route('home')->with('message', 'Data Berhasil Disimpan');
    }

    public function update_rencana(Request $request, string $id){
        $data = $request->all();
        $data = $request->except(['_method', '_token']);

        Schedule::where('id', $id)->update($data);
        return redirect()->route('home')->with('message', 'Data Berhasil Diubah');
    }

    public function get_event($id, $pupuk){
        $event = [
            [
                'title' => 'Pengairan',
                'start_event' => 14,
                'end_event' => 14,
                'tipe' => $id,
            ],
            [
                'title' => 'Penyiangan gulma',
                'start_event' => 15,
                'end_event' => 15,
                'tipe' => $id,
            ],
            [
                'title' => 'Penyiangan gulma',
                'start_event' => 27,
                'end_event' => 27,
                'tipe' => $id,
            ],
            [
                'title' => 'Pengairan',
                'start_event' => 28,
                'end_event' => 28,
                'tipe' => $id,
            ],
            [
                'title' => 'Pengairan',
                'start_event' => 42,
                'end_event' => 42,
                'tipe' => $id,
            ],
            [
                'title' => 'Penyiangan gulma',
                'start_event' => 43,
                'end_event' => 43,
                'tipe' => $id,
            ],
            [
                'title' => 'Pengairan',
                'start_event' => 56,
                'end_event' => 56,
                'tipe' => $id,
            ],
            [
                'title' => 'Pengairan',
                'start_event' => 70,
                'end_event' => 70,
                'tipe' => $id,
            ],
        ];

        foreach($pupuk as $p){
            array_push($event, $p);
        }
        
        return $event;
    }
}
