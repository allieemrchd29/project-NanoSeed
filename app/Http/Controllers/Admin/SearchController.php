namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');
        $hasil = Kampanye::where('nama_kampanye', 'LIKE', "%{$query}%")->get();
        return view('admin.search-results', compact('hasil', 'query'));
    }
}