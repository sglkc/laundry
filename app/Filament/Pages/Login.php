<?php

use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Support\Colors\Color;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
                $this->getBackComponent(),
            ])
            ->statePath('data');
    }

    protected function getBackComponent(): Component
    {
        return Actions::make([
            Action::make('back')
                ->action(route('index'))
                ->color(Color::Slate)
                ->extraAttributes([
                    'style' => 'opacity: 50%'
                ])
        ])
            ->fullWidth();
    }
}
