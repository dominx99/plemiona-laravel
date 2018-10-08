<?php

namespace App\Observers;

use App\Http\Repositories\VillageRepository;
use App\User;
use App\Village;

class UserObserver
{
    /**
     * @var \App\Http\Repositories\VillageRepository $villages
     */
    protected $villages;

    /**
     * @param \App\Http\Repositories\VillageRepository $villages
     */
    public function __construct(VillageRepository $villages)
    {
        $this->villages = $villages;
    }

    /**
     * @param User $user
     * @return void
     */
    public function created(User $user)
    {
        $other = false;

        $this->createVillageForUser($user);
        $this->createBarbarianVillages();
    }

    /**
     * @param \App\User $user
     * @return void
     */
    protected function createVillageForUser(User $user): void
    {
        $coordinates = $this->generateCoordinates();

        $user->villages()->create([
            'name' => "Wioska {$user->nick}",
            'x'    => $coordinates['x'],
            'y'    => $coordinates['y'],
        ]);
    }

    /**
     * @return void
     */
    protected function createBarbarianVillages(): void
    {
        for ($i = 0; $i <= 1; $i++) {
            $coordinates = $this->generateCoordinates();

            Village::create([
                'user_id' => 0,
                'name'    => 'Wioska barbarzyńska',
                'x'       => $coordinates['x'],
                'y'       => $coordinates['y'],
            ]);
        }
    }

    /**
     * @return array
     */
    protected function generateCoordinates(): array
    {
        do {
            $x = rand(1, 100);
            $y = rand(1, 100);

            $other = $this->villages->existsByCoordinates($x, $y);
        } while ($other);

        return [
            'x' => $x,
            'y' => $y,
        ];
    }
}
