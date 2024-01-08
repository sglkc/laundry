<?php

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Support\Colors\Color;
use Phpsa\FilamentPasswordReveal\Password;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordComponent(),
                $this->getRememberFormComponent(),
                $this->getBackComponent(),
            ])
            ->statePath('data');
    }

    protected function getPasswordComponent(): Component
    {
        return Password::make('password')
            ->revealable()
            ->autocomplete();
    }

    protected function getBackComponent(): Component
    {
        return Actions::make([
            Action::make('back')
                ->url('/')
                ->color(Color::Slate)
                ->extraAttributes([
                    'href' => '/'
                ])
        ])
            ->fullWidth();
    }
}
