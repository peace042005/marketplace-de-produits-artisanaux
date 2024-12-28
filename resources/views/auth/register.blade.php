<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Nom et Prénom -->
        <div class="flex gap-4">
            <div class="w-1/2">
                <x-input-label for="name" :value="__('Nom')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="w-1/2">
                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input id="prenom" class="block mt-1 w-full" type="text" name="prenom" :value="old('prenom')" required autocomplete="prenom" />
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </div>
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Téléphone -->
        <div class="mt-4">
            <x-input-label for="telephone" :value="__('Téléphone')" />
            <x-text-input id="telephone" class="block mt-1 w-full" type="text" name="telephone" :value="old('telephone')" required autocomplete="telephone" />
            <x-input-error :messages="$errors->get('telephone')" class="mt-2" />
        </div>

        <!-- Sexe & Rôle -->
        <div class="flex gap-4">
            <!-- Sexe -->
            <div class="w-1/2">
                <x-input-label :value="__('Sexe')" />
                <div class="flex flex-col gap-2 mt-2">
                    <label class="flex items-center">
                        <input type="radio" name="sexe" value="masculin" {{ old('sexe') == 'Masculin' ? 'checked' : '' }} required>
                        <span class="ml-2">{{ __('Masculin') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="sexe" value="féminin" {{ old('sexe') == 'Féminin' ? 'checked' : '' }} required>
                        <span class="ml-2">{{ __('Féminin') }}</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('sexe')" class="mt-2" />
            </div>

            <!-- Rôle -->
            <div class="w-1/2">
                <x-input-label :value="__('Rôle')" />
                <div class="flex flex-col gap-2 mt-2">
                    <label class="flex items-center">
                        <input type="radio" name="role_id" value="2" {{ old('role_id') == '2' ? 'checked' : '' }} required>
                        <span class="ml-2">{{ __('Artisan') }}</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="role_id" value="3" {{ old('role_id') == '3' ? 'checked' : '' }} required>
                        <span class="ml-2">{{ __('Client') }}</span>
                    </label>
                </div>
                <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
            </div>
        </div>


        <!-- Date de naissance -->
        <div class="mt-4">
            <x-input-label for="date_naissance" :value="__('Date de naissance')" />
            <x-text-input id="date_naissance" class="block mt-1 w-full" type="date" name="date_naissance" :value="old('date_naissance')" required />
            <x-input-error :messages="$errors->get('date_naissance')" class="mt-2" />
        </div>

        <!-- Poids et Taille -->
        <div class="flex gap-4 mt-4">
            <div class="w-1/2">
                <x-input-label for="poids" :value="__('Poids (kg)')" />
                <x-text-input id="poids" class="block mt-1 w-full" type="number" name="poids" :value="old('poids')" />
                <x-input-error :messages="$errors->get('poids')" class="mt-2" />
            </div>
            <div class="w-1/2">
                <x-input-label for="taille" :value="__('Taille (cm)')" />
                <x-text-input id="taille" class="block mt-1 w-full" type="number" name="taille" :value="old('taille')" />
                <x-input-error :messages="$errors->get('taille')" class="mt-2" />
            </div>
        </div>

        <!-- Adresse -->
        <div class="mt-4">
            <x-input-label for="adresse" :value="__('Adresse')" />
            <x-text-input id="adresse" class="block mt-1 w-full" type="text" name="adresse" :value="old('adresse')" />
            <x-input-error :messages="$errors->get('adresse')" class="mt-2" />
        </div>

        <!-- Biographie -->
        <div class="mt-4">
            <x-input-label for="biographie" :value="__('Biographie')" />
            <textarea id="biographie" name="biographie" class="block mt-1 w-full" rows="3">{{ old('biographie') }}</textarea>
            <x-input-error :messages="$errors->get('biographie')" class="mt-2" />
        </div>

        <!-- Photo de profil -->
        <div class="mt-4">
            <x-input-label for="photo_profil" :value="__('Photo de profil')" />
            <x-text-input id="photo_profil" class="block mt-1 w-full" type="file" name="photo_profil" />
            <x-input-error :messages="$errors->get('photo_profil')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirmation du mot de passe -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Boutons -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Déjà inscrit ?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('S\'inscrire') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
