<?php declare(strict_types=1);

/**
 * This file is part of Reymon.
 * Reymon is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * Reymon is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * @author    AhJ <AmirHosseinJafari8228@gmail.com>
 * @copyright 2023-2024 AhJ <AmirHosseinJafari8228@gmail.com>
 * @license   https://choosealicense.com/licenses/gpl-3.0/ GPLv3
 */

namespace Reymon\Type\Chat;

use Reymon\Mtproto\Type;

final class AdministratorRights implements Type
{
    /** Whether the user's presence in the chat is hidden */
    private bool $anonymous;

    /** Whether the administrator can access the chat event log, boost list in channels, see channel members, report spam messages, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege */
    private bool $manageChat;

    /** Whether the administrator can manage video chats */
    private bool $manageCall;

    /** Whether the administrator can restrict, ban or unban chat members, or access supergroup statistics */
    private bool $banUsers;

    /** Whether the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user) */
    private bool $promote;

    /** Whether the user is allowed to change the chat title, photo and other settings */
    private bool $changeInfo;

    /** Whether the user is allowed to invite new users to the chat */
    private bool $inviteUsers;

    /** Whether the administrator can delete messages of other users */
    private bool $deleteMessages;

    /** Whether the administrator can post messages in the channel, or access channel statistics; channels only */
    private bool $postMessages;

    /** Whether the administrator can edit messages of other users and can pin messages; channels only */
    private bool $editMessages;

    /** Whether the user is allowed to pin messages; groups and supergroups only */
    private bool $pinMessages;

    /** Whether the administrator can post stories in the channel; channels only */
    private bool $postStories;

    /** Whether the administrator can edit stories posted by other users; channels only */
    private bool $editStories;

    /** Whether the administrator can delete stories posted by other users; channels only */
    private bool $deleteStories;

    /** Whether the user is allowed to create, rename, close, and reopen forum topics; supergroups only */
    private bool $manageTopics;

    /**
     * @internal
     */
    public function __construct(array $administratorRights)
    {
        $this->anonymous      = $administratorRights['is_anonymous'];
        $this->manageChat     = isset($administratorRights['can_manage_chat']);
        $this->manageCall     = isset($administratorRights['can_manage_video_chats']);
        $this->banUsers       = isset($administratorRights['can_restrict_members']);
        $this->promote        = isset($administratorRights['can_promote_members']);
        $this->changeInfo     = isset($administratorRights['can_change_info']);
        $this->inviteUsers    = isset($administratorRights['can_invite_users']);
        $this->deleteMessages = isset($administratorRights['can_delete_messages']);
        $this->postMessages   = isset($administratorRights['can_post_messages']);
        $this->editMessages   = isset($administratorRights['can_edit_messages']);
        $this->pinMessages    = isset($administratorRights['can_pin_messages']);
        $this->postStories    = isset($administratorRights['can_post_stories']);
        $this->editStories    = isset($administratorRights['can_edit_stories']);
        $this->deleteStories  = isset($administratorRights['can_delete_stories']);
        $this->manageTopics   = isset($administratorRights['can_manage_topics']);
    }

    /**
     * @param bool $anonymous      Whether the user's presence in the chat is hidden
     * @param bool $manageChat     Whether the administrator can access the chat event log, boost list in channels, see channel members, report spam messages, see anonymous administrators in supergroups and ignore slow mode. Implied by any other administrator privilege
     * @param bool $videoChats     Whether the administrator can manage video chats
     * @param bool $banUsers       Whether the administrator can restrict, ban or unban chat members, or access supergroup statistics
     * @param bool $promote        Whether the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted, directly or indirectly (promoted by administrators that were appointed by the user)
     * @param bool $changeInfo     Whether the user is allowed to change the chat title, photo and other settings
     * @param bool $inviteUsers    Whether the user is allowed to invite new users to the chat
     * @param bool $deleteMessages Whether the administrator can delete messages of other users
     * @param bool $postMessages   Whether the administrator can post messages in the channel, or access channel statistics; channels only
     * @param bool $editMessages   Whether the administrator can edit messages of other users and can pin messages; channels only
     * @param bool $pinMessages    Whether the user is allowed to pin messages; groups and supergroups only
     * @param bool $postStories    Whether the administrator can post stories in the channel; channels only
     * @param bool $editStories    Whether the administrator can edit stories posted by other users; channels only
     * @param bool $deleteStories  Whether the administrator can delete stories posted by other users; channels only
     * @param bool $manageTopics   Whether the user is allowed to create, rename, close, and reopen forum topics; supergroups only
     */
    public static function new(bool $anonymous = false, bool $manageChat = false, bool $manageCall = false, bool $banUsers = false, bool $promote = false, bool $changeInfo = false, bool $inviteUsers = false, bool $deleteMessages = false, bool $postMessages = false, bool $editMessages = false, bool $pinMessages = false, bool $postStories = false, bool $editStories = false, bool $deleteStories = false, bool $manageTopics = false): self
    {
        return new static([
            'is_anonymous'           => $anonymous,
            'can_manage_chat'        => $manageChat,
            'can_manage_video_chats' => $manageCall,
            'can_restrict_members'   => $banUsers,
            'can_promote_members'    => $promote,
            'can_change_info'        => $changeInfo,
            'can_invite_users'       => $inviteUsers,
            'can_delete_messages'    => $deleteMessages,
            'can_post_messages'      => $postMessages,
            'can_edit_messages'      => $editMessages,
            'can_pin_messages'       => $pinMessages,
            'can_post_stories'       => $postStories,
            'can_edit_stories'       => $editStories,
            'can_delete_stories'     => $deleteStories,
            'can_manage_topics'      => $manageTopics,
        ]);
    }

    public static function fromMtproto($adminiRights): self
    {
        return static::new(
            $adminiRights['anonymous']      ?? false,
            $adminiRights['other']          ?? false,
            $adminiRights['manage_call']    ?? false,
            $adminiRights['ban_users']      ?? false,
            $adminiRights['add_admins']     ?? false,
            $adminiRights['change_info']    ?? false,
            $adminiRights['invite_users']   ?? false,
            $adminiRights['delete_messages']?? false,
            $adminiRights['post_messages']  ?? false,
            $adminiRights['edit_messages']  ?? false,
            $adminiRights['pin_messages']   ?? false,
            $adminiRights['post_stories']   ?? false,
            $adminiRights['edit_stories']   ?? false,
            $adminiRights['delete_stories'] ?? false,
            $adminiRights['manage_topics']  ?? false,
        );
    }

    public function changeInfo(?bool $changeInfo = null): self
    {
        $this->changeInfo = $changeInfo;
        return $this;
    }

    public function canChangeInfo(): ?bool
    {
        return $this->changeInfo;
    }

    public function postMessages(?bool $postMessages = null): self
    {
        $this->postMessages = $postMessages;
        return $this;
    }

    public function canPostMessages(): ?bool
    {
        return $this->postMessages;
    }

    public function canEditMessages(): ?bool
    {
        return $this->editMessages;
    }

    public function editMessages(?bool $editMessages = null): self
    {
        $this->editMessages = $editMessages;
        return $this;
    }

    public function canDeleteMessages(): ?bool
    {
        return $this->deleteMessages;
    }

    public function deleteMessages(?bool $deleteMessages = null): self
    {
        $this->deleteMessages;
        return $this;
    }

    public function canBanUsers(): ?bool
    {
        return $this->banUsers;
    }

    public function banUsers(?bool $banUsers = null): self
    {
        $this->banUsers = $banUsers;
        return $this;
    }

    public function canInviteUsers(): ?bool
    {
        return $this->inviteUsers;
    }

    public function inviteUsers(?bool $inviteUsers = null): self
    {
        $this->inviteUsers = $inviteUsers;
        return $this;
    }

    public function canPinMessages(): ?bool
    {
        return $this->pinMessages;
    }

    public function pinMessages(?bool $pinMessages = null): self
    {
        $this->pinMessages = $pinMessages;
        return $this;
    }

    public function canAddAdmins(): ?bool
    {
        return $this->promote;
    }

    public function addAdmins(?bool $addAdmins = null): self
    {
        $this->promote = $addAdmins;
        return $this;
    }

    public function isAnonymous(): ?bool
    {
        return $this->anonymous;
    }

    public function anonymous(?bool $anonymous = null): self
    {
        $this->anonymous = $anonymous;
        return $this;
    }

    public function canManageCall(): ?bool
    {
        return $this->manageCall;
    }

    public function manageCall(?bool $manageCall = null): self
    {
        $this->manageCall = $manageCall;
        return $this;
    }
    public function canManageChat(): ?bool
    {
        return $this->manageChat;
    }

    public function manageChat(?bool $manageChat = null): self
    {
        $this->manageChat = $manageChat;
        return $this;
    }
    public function canManageTopics(): ?bool
    {
        return $this->manageTopics;
    }

    public function manageTopics(?bool $manageTopics = null): self
    {
        $this->manageTopics = $manageTopics;
        return $this;
    }
    public function canPostStories(): ?bool
    {
        return $this->postStories;
    }

    public function postStories(?bool $postStories = null): self
    {
        $this->postStories = $postStories;
        return $this;
    }
    public function canEditStories(): ?bool
    {
        return $this->editStories;
    }

    public function editStories(?bool $editStories = null): self
    {
        $this->editStories = $editStories;
        return $this;
    }
    public function canDeleteStories(): ?bool
    {
        return $this->deleteStories;
    }

    public function deleteStories(?bool $deleteStories = null): self
    {
        $this->deleteStories = $deleteStories;
        return $this;
    }

    #[\Override]
    public function toMtproto(): array
    {
        return \array_filter_null([
            '_'               => 'chatAdminRights',
            'change_info'     => $this->changeInfo,
            'post_messages'   => $this->postMessages,
            'edit_messages'   => $this->editMessages,
            'delete_messages' => $this->deleteMessages,
            'ban_users'       => $this->banUsers,
            'invite_users'    => $this->inviteUsers,
            'pin_messages'    => $this->pinMessages,
            'add_admins'      => $this->promote,
            'anonymous'       => $this->anonymous,
            'manage_call'     => $this->manageCall,
            'other'           => $this->manageChat,
            'manage_topics'   => $this->manageTopics,
            'post_stories'    => $this->postStories,
            'edit_stories'    => $this->editStories,
            'delete_stories'  => $this->deleteStories
        ]);
    }

    #[\Override]
    public function toApi(): array
    {
        return \array_filter_null([
            'is_anonymous'           => $this->anonymous,
            'can_change_info'        => $this->changeInfo,
            'can_post_messages'      => $this->postMessages,
            'can_edit_messages'      => $this->editMessages,
            'can_delete_messages'    => $this->deleteMessages,
            'can_restrict_members'   => $this->banUsers,
            'can_invite_users'       => $this->inviteUsers,
            'can_pin_messages'       => $this->pinMessages,
            'can_promote_members'    => $this->promote,
            'can_manage_video_chats' => $this->manageCall,
            'can_manage_chat'        => $this->manageChat,
            'can_manage_topics'      => $this->manageTopics,
            'can_post_stories'       => $this->postStories,
            'can_edit_stories'       => $this->editStories,
            'can_delete_stories'     => $this->deleteStories,
        ]);
    }

    /**
     * @internal
     */
    #[\Override]
    public function jsonSerialize(): array
    {
        return $this->toApi();
    }
}
