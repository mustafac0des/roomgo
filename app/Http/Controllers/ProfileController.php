namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'gender' => 'nullable|string',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'role' => 'nullable|string|in:user,admin',
        ]);

        $user = Auth::user();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('picture')) {
            if ($user->picture) {
                Storage::delete('public/' . $user->picture);
            }
            $path = $request->file('picture')->store('profile_pictures', 'public');
            $data['picture'] = $path;
        }

        $user->update($data);

        return redirect('/')->with('status', 'Profile updated successfully.');
    }
}


