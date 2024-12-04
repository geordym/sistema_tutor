<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        Event::listen(BuildingMenu::class, function (BuildingMenu $event) {

            if (Auth::check() && (Auth::user()->user_type === 'user')) {

            $tokens = Auth::user()->collaborator ? Auth::user()->collaborator->tokens : 0;

            $event->menu->add(
                [
                    'text' => 'Mis Tokens: ' . $tokens,
                    'url'  => '/collaborators/my-tokens', 
                    'icon' => 'fas fa-coins', 
                ],
                'header' 
            );

        }


            if (Auth::check() && (Auth::user()->user_type === 'admin')) {
                $event->menu->add(
                    [
                        'text' => 'Usuarios',
                        'url'  => '/admin/usuarios',
                    ],
                );
            }

            if (Auth::check() && (Auth::user()->user_type === 'user')) {
                $event->menu->add(
                    [
                        'text' => 'Cursos',
                        'url'  => '/collaborators/cursos',
                    ],

                );
              
                $event->menu->add(
                    [
                        'text' => 'Alumnos',
                        'url'  => '/collaborators/alumnos',
                    ],

                );

                $event->menu->add(
                    [
                        'text' => 'Certificados',
                        'url'  => '/collaborators/certificados',
                    ],

                );

             
            }

            if (Auth::check() && (Auth::user()->user_type === 'tutor')) {
                $event->menu->add(
                    [
                        'text' => 'Agenda',
                        'url'  => '/tutor/agenda',
                    ],

                );
              
                $event->menu->add(
                    [
                        'text' => 'Citas',
                        'url'  => '/tutor/citas',
                    ],

                );

                $event->menu->add(
                    [
                        'text' => 'Saldo',
                        'url'  => '/tutor/saldo',
                    ],

                );
             
            }

            $event->menu->add([
                'text' => 'Perfil',
                'url'  => '/perfil',
            ]);

            $event->menu->add([
                'text' => 'Acceso',
                'url'  => '/change-password',
            ]);

        });


        }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
