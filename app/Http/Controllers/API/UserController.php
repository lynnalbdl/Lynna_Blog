<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
     // Afficher le profil de l'utilisateur authentifié
     public function profile(Request $request)
     {
         return response()->json($request->user());
     }
      public function updateProfile(Request $request)
      {
          // Valider et mettre à jour l'utilisateur
          $user = $request->user();
          $data = $request->validate([
              'name' => 'required|string|max:255',
              // autres champs que vous souhaitez mettre à jour...
          ]);
          
          $user->update($data);
  
          return response()->json(['message' => 'Profil mis à jour', 'user' => $user]);
      }
}
