# Icon Update Task - Zalo, Messenger, Call Icons with Device Selection

## Current Status: In Progress

### Completed Tasks:
- [ ] Analysis of current implementation
- [ ] Plan creation and user approval

### Pending Tasks:
- [ ] Create database migration for image upload fields
- [ ] Update ZaloSetting model to support image uploads
- [ ] Update admin interface with file upload functionality
- [ ] Add image preview functionality in admin
- [ ] Update frontend to use dynamic icons from database
- [ ] Update API response to handle both FontAwesome and image icons
- [ ] Add file upload validation and storage
- [ ] Test the complete functionality

### Implementation Steps:

1. **Database Changes**
   - Create migration to add image file fields to zalo_settings table
   - Update ZaloSetting model with new fillable fields and accessors

2. **Admin Interface Updates**
   - Add file upload inputs for each icon type
   - Add image preview functionality
   - Update form validation to handle both FontAwesome classes and uploaded files
   - Add JavaScript for dynamic preview

3. **Frontend Updates**
   - Update app.blade.php to use dynamic icons from API
   - Modify JavaScript to handle both FontAwesome classes and image URLs
   - Update CSS for proper icon display

4. **API Updates**
   - Modify /api/zalo-contact endpoint to return appropriate icon data
   - Handle both FontAwesome classes and image URLs

5. **File Upload Handling**
   - Configure storage for uploaded icons
   - Add proper validation for image files
   - Handle file naming and organization

### Notes:
- Current icons use FontAwesome classes: fas fa-comment, fab fa-facebook-messenger, fas fa-phone
- Frontend currently uses static images: icon_zalo.png, icon_mess.png, icon_call.png
- Need to maintain backward compatibility with existing FontAwesome icons
- File uploads should support common image formats (PNG, JPG, SVG, WebP)
