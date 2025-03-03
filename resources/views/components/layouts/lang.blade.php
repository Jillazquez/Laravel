
<x-dropdown>
    <x-slot name="trigger" class="">
        <!--El título-->

        <span>{{config('languages')[App::getLocale()]['name']}}</span>
        <span>{{config('languages')[App::getLocale()]['flag']}}</span>
   </x-slot>
    <x-slot name="content">
        <!--El contenido -->
        @foreach(config("languages") as $code=>$lang)


            <div class="text-black">
                <a href="{{route('language',$code)}}"
                class="hover:bg-gray-200 p-2" >
                <span>{{$lang['name']}} </span>
                <span>{{$lang['flag']}} </span>
                </a>
            </div>


        @endforeach


    </x-slot>




</x-dropdown>
