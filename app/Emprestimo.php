<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

/**
 * App\Emprestimo
 *
 * @property-read \App\Status $status
 * @property-read \App\Livro $livro
 * @property-read \App\User $dono
 * @property-read \App\User $solicitante
 */
class Emprestimo extends Model {

    use SoftDeletes;

	protected $fillable = ['data', 'obs'];
    protected $dates = ['data', 'deleted_at'];

    public function status() {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function livro() {
        return $this->belongsTo('App\Livro', 'livro_id');
    }

    public function dono() {
        return $this->belongsTo('App\User', 'dono_id');
    }

    public function solicitante() {
        return $this->belongsTo('App\User', 'solicitante_id');
    }

    public static function notificacoes() {
        $paraMim = Emprestimo::where('dono_id', Auth::user()->id)
            ->whereHas('status', function($q) {
                $q->where('nome', 'Solicitado');
            })
            ->count();

        $concluir = Emprestimo::where('dono_id', Auth::user()->id)
            ->whereHas('status', function($q) {
                $q->where('nome', 'Emprestado');
            })
            ->count();

        return array('paraMim' => $paraMim, 'concluir' => $concluir);
    }
}
