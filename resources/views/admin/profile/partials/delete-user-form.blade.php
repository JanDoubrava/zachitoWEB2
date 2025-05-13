<section>
    <form method="post" action="{{ route('admin.profile.destroy') }}" class="space-y-6">
        @csrf
        @method('delete')

        <div>
            <h3 class="text-lg font-medium text-gray-900">Smazání účtu</h3>
            <p class="mt-1 text-sm text-gray-600">
                Jakmile je váš účet smazán, všechna vaše data budou trvale odstraněna. Před smazáním účtu si prosím stáhněte všechna data, která chcete zachovat.
            </p>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                Pro potvrzení zadejte své heslo
            </label>
            <input type="password" name="password" id="password" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Potvrzení hesla
            </label>
            <input type="password" name="password_confirmation" id="password_confirmation" required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('password_confirmation')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                    onclick="return confirm('Opravdu chcete smazat svůj účet? Tato akce je nevratná.')">
                Smazat účet
            </button>
        </div>
    </form>
</section> 