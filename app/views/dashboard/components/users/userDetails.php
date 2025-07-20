
    <div class="modal-overlay fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-2xl mx-4 max-h-[90vh] overflow-y-auto">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-900">User Details</h3>
            <button class="modal-close text-gray-400 hover:text-gray-600">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          </div>
          <div class="space-y-6">
            <div class="flex items-center space-x-4">
              <div class="w-16 h-16 bg-gradient-to-br from-primary to-orange-600 rounded-full flex items-center justify-center">
                <span class="text-white text-xl font-semibold">${user.name.charAt(0)}</span>
              </div>
              <div>
                <h4 class="text-lg font-semibold text-gray-900">${user.name}</h4>
                <p class="text-gray-600">${user.email}</p>
                <span class="status-badge status-${user.status}">${user.status}</span>
              </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h5 class="font-semibold text-gray-900 mb-2">Account Information</h5>
                <div class="space-y-2 text-sm">
                  <p><span class="font-medium">User Type:</span> ${user.type}</p>
                  <p><span class="font-medium">Joined:</span> ${user.joined}</p>
                  <p><span class="font-medium">Last Login:</span> 2 hours ago</p>
                  <p><span class="font-medium">Total Orders:</span> 23</p>
                </div>
              </div>
              <div>
                <h5 class="font-semibold text-gray-900 mb-2">Activity Stats</h5>
                <div class="space-y-2 text-sm">
                  <p><span class="font-medium">Total Spent:</span> $1,247.50</p>
                  <p><span class="font-medium">Reviews:</span> 12</p>
                  <p><span class="font-medium">Reports:</span> 0</p>
                  <p><span class="font-medium">Rating:</span> 4.8/5</p>
                </div>
              </div>
            </div>
            <div class="flex justify-end space-x-3 pt-4 border-t">
              <button class="modal-close px-4 py-2 text-gray-600 hover:text-gray-800">Close</button>
              <button class="btn-secondary">Edit User</button>
              <button class="btn-danger">Ban User</button>
            </div>
          </div>
        </div>
    </div>