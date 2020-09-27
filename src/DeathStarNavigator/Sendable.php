<?php


namespace DeathStarNavigator;

interface Sendable
{
    public function send() : CrashReportInterface;
}
