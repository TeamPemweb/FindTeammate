<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            'portfolios' => 'nullable|string',
        ]);

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil_url) {
                Storage::disk('public')->delete($user->foto_profil_url);
            }
            $path = $request->file('foto_profil')->store('profile_pictures', 'public');
            $user->foto_profil_url = $path;
        }

        if ($request->has('skills')) {
            $skillsArray = array_map('trim', explode(',', $request->skills));
            $skillsArray = array_filter($skillsArray);

            $skillIds = [];
            foreach ($skillsArray as $skillName) {
                $skill = \App\Models\Skill::firstOrCreate(['nama_skill' => $skillName]);
                $skillIds[] = $skill->skill_id;
            }
            $user->skills()->sync($skillIds);
        }

        if ($request->has('portfolios')) {
            $portfoliosArray = array_map('trim', explode(',', $request->portfolios));
            $portfoliosArray = array_filter($portfoliosArray);

            $user->portfolios()->delete();
            foreach ($portfoliosArray as $portfolioName) {
                $user->portfolios()->create([
                    'judul' => $portfolioName,
                    'tipe' => 'link',
                ]);
            }
        }

        if ($request->has('bio')) {
            $user->bio = $request->bio;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }
}
