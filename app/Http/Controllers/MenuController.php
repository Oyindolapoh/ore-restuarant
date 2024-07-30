<?php
use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        return Menu::all();
    }

    public function show($id)
    {
        return Menu::findOrFail($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'is_discounted' => 'boolean',
            'category' => 'required|in:food,drink',
        ]);

        return Menu::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
            'is_discounted' => 'boolean',
            'category' => 'in:food,drink',
        ]);

        $menu->update($request->all());

        return $menu;
    }

    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();

        return response()->json(['message' => 'Menu item deleted']);
    }

    public function discounted()
    {
        return Menu::where('is_discounted', true)->get();
    }

    public function drinks()
    {
        return Menu::where('category', 'drink')->get();
    }
}

