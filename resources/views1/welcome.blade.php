I have a Laravel website called **Sahayika**. Redesign the **entire homepage** to feel like a modern, trustworthy Indian platform for finding domestic and family-support help.
Current title:
`<title>Sahayika — Trusted Help, Right at Your Doorstep</title>`
## 1. Brand & Messaging
Replace the generic Western-style messaging with an **Indian, warm, familiar, respectful and modern** positioning.
Core idea:
**"अपने घर के काम के लिए भरोसेमंद मदद"**
Sahayika should help users discover people for:
* काम वाली बाई / घरेलू सहायिका
* झाड़ू-पोंछा, बर्तन, सफाई
* खाना बनाने वाली
* कपड़े धोना/प्रेस
* Baby care / आया / nanny
* बच्चों की मालिश
* बच्चों की देखभाल
* बुजुर्गों की देखभाल
* Part-time / Full-time domestic help
Use natural Indian terms such as **काम वाली बाई, सहायिका, मौसी, आया, नानी, घर की मदद** where appropriate, while keeping the brand professional and respectful. Avoid stereotypes or language that objectifies workers.
## 2. Hero Section
Create a strong Indian-focused hero.
Preferred concept:
**"घर के काम में मदद चाहिए? भरोसेमंद सहायिका ढूंढें।"**
Create a better final headline/tagline if you can improve it.
Clearly communicate:
* What Sahayika does
* Types of help available
* Trust/reliability
* How to start
Primary CTA: **"सहायिका खोजें"**
Secondary CTA: **"काम के लिए रजिस्टर करें"**
Use simple Hindi/Hinglish instead of corporate wording.
## 3. Redesign ALL Homepage Sections
Inspect the existing homepage first, then improve every section instead of only changing the hero.
Update:
* Headings/subheadings
* Service cards
* CTAs
* Microcopy
* Icons
* Layout
* Visual hierarchy
* Trust messaging
* Empty states
* Section ordering
Suggested sections:
**Services — "काम किस तरह की मदद चाहिए?"**
* घर का काम: झाड़ू-पोंछा, बर्तन, सफाई, कपड़े
* खाना: खाना बनाने वाली, रसोई की मदद
* बच्चों की देखभाल: Baby Care, आया/Nanny, बच्चों की मालिश
* बुजुर्गों की देखभाल
* Full-time / Part-time घरेलू मदद
**How It Works**
`काम बताएं → सहायिका देखें → प्रोफाइल समझें → संपर्क करें → काम तय करें`
**Trust Section**
Use only claims actually supported by the application, such as profiles, experience, services, location, contact information, etc. **Never claim "verified", "police verified", "100% safe", etc. unless the backend genuinely supports it.**
## 4. Indian Visual Identity
Make it feel like a **modern Indian startup**, not a Western marketplace or traditional/government website.
Use:
* Warm/earthy visual language
* Clean modern UI
* Indian household context
* Warm lighting
* Natural family interactions
* Subtle Indian design cues
Avoid excessive:
* Tricolor
* Mandalas
* Religious symbols
* Cartoonish Indian graphics
* Stereotypical imagery
## 5. Images — VERY IMPORTANT
Replace generic/irrelevant imagery with **high-quality, realistic Indian-context images** showing:
* Indian domestic helper/household work
* Indian families with helpers
* Cooking and cleaning
* Baby care / baby massage
* Elder care
* Comfortable family-helper interactions
Images must be **Indian, authentic, natural, professional and warm**, not obviously Western stock photos.
Use legitimate sources such as **Unsplash, Pexels or Pixabay**. Do not invent URLs.
For every image ensure:
* Publicly accessible
* Relevant to the section
* High resolution
* No broken image
* Suitable licensing
* Responsive `object-fit: cover`
* Descriptive SEO-friendly `alt`
## 6. Language & UX
Use familiar Indian wording:
**घर की मदद, घरेलू सहायिका, काम वाली बाई, झाड़ू-पोंछा, बर्तन, खाना बनाने वाली, बच्चों की देखभाल, बेबी केयर, भरोसेमंद मदद**
Do not force Hindi everywhere; use Hindi/Hinglish naturally.
Make the homepage:
* Mobile-first
* Fast-loading
* Touch-friendly
* Accessible
* Easy to search
* Clear CTAs
* Good contrast
* Minimal unnecessary animation
## 7. SEO
Improve:
* `<title>`
* Meta description
* H1/H2
* Image alt text
* Natural keywords
Target relevant searches such as:
**घरेलू सहायिका, काम वाली बाई, maid near me, maid service, घर की काम वाली, झाड़ू पोछा वाली, बर्तन वाली, खाना बनाने वाली, baby care, nanny, बच्चों की मालिश, domestic help**
Avoid keyword stuffing.
## 8. Development Rules
Before changing anything, inspect the existing Laravel project:
* Blade/templates/components
* CSS/Tailwind/Bootstrap
* JavaScript
* Routes
* Existing service/category data
* Image handling
* Responsive implementation
Reuse existing functionality and components where possible.
**Do not break routes, authentication, database logic, APIs or existing functionality.**
Do not blindly replace the homepage. Make clean, maintainable, production-ready changes.
## 9. Final Quality Goal
The first impression should be:
**"Haan, yahan mujhe apne area mein ghar ke kaam, बर्तन, झाड़ू-पोंछा, खाना बनाने, baby care ya बच्चों की देखभाल के लिए सहायिका मिल सकती है."**
Overall feeling:
**अपनापन + भरोसा + सुविधा + आधुनिकता**
After implementation, briefly report:
1. New title
2. Final hero headline/tagline
3. Sections redesigned
4. Images added/replaced + sources
5. UX/SEO improvements
6. Assumptions
7. Unsupported claims/features intentionally avoided
**Do the implementation, not just recommendations. First inspect the existing code and then modify it.**
2: prompt 

I have an existing Laravel application called **Sahayika**, a platform for finding domestic and family-support helpers in India.
I now need to build/extend the **database structure for users, helpers, services, locations and related entities**, along with realistic demo data for **Indore, Madhya Pradesh** for development and testing.
## 1. First inspect the existing project
Before creating anything, inspect the existing Laravel application:
* Existing migrations
* `users` table/model
* Existing models and relationships
* Existing service/category tables
* Existing authentication
* Existing controllers
* Existing routes
* Existing seeders/factories
* Existing database conventions
**Do not create duplicate tables or break the existing schema.**
If an existing table already supports part of this requirement, extend/reuse it instead of creating another table unnecessarily.
Use the Laravel version and database configuration already present in the project.
---
## 2. Core database requirement
Design a clean relational database for a domestic-help marketplace.
The structure should support:
### Users
Users can be:
* Customer / household
* Helper / Sahayika
* Admin
A helper should have a detailed profile separate from basic authentication information.
### Helpers / Sahayika Profiles
Store realistic information such as:
* Name
* Gender
* Date of birth / age where appropriate
* Profile photo
* Mobile number
* Alternate contact if needed
* About/bio
* Experience in years
* Previous work experience
* Expected salary
* Salary type: monthly / daily / hourly
* Work type: full-time / part-time
* Availability
* Preferred working hours
* Languages
* Address
* Locality/area
* City
* State
* Pincode
* Latitude/longitude if useful
* Profile status
* Availability status
Do not store unnecessary sensitive information.
---
## 3. Services / Categories
Create a flexible service/category structure rather than hardcoding services.
The platform should support categories such as:
### घर का काम
* झाड़ू-पोंछा
* बर्तन
* घर की सफाई
* कपड़े धोना
* कपड़े प्रेस करना
### खाना
* खाना बनाने वाली
* रसोई की मदद
* रोज़ का खाना
### बच्चों की देखभाल
* Baby Care
* आया / Nanny
* बच्चों की मालिश
* बच्चों को संभालना
### बुजुर्गों की देखभाल
* Elder Care
* रोज़मर्रा की सहायता
### अन्य
* Full-time घरेलू सहायिका
* Part-time घरेलू सहायिका
* हरफनमौला / All-rounder
Use parent categories + child services if that makes the schema cleaner.
A helper must be able to provide **multiple services**, so use a proper many-to-many relationship.
---
## 4. Location structure
Design location data suitable for an Indian city.
For testing, focus on **Indore, Madhya Pradesh**.
Include realistic Indore localities/areas such as:
* Vijay Nagar
* Scheme No. 54
* Scheme No. 78
* Bengali Square
* Saket Nagar
* Palasia
* Bhanwar Kuan
* Rau
* Nipania
* Mahalaxmi Nagar
* Sudama Nagar
* Annapurna Road
* Rajendra Nagar
* Tilak Nagar
* Geeta Bhawan
* Bhawarkua
* LIG Colony
* MIG Colony
* Khajrana
* Aerodrome Road
* Silicon City
* Super Corridor
* Kanadia Road
* Rau
* MR-10 area
Avoid creating inaccurate addresses for real people. Demo addresses should clearly be fictional/testing data.
Prefer a normalized location structure if appropriate:
`states → cities → localities`
or another clean structure that avoids unnecessary duplication.
---
## 5. Helper-Service relationship
A helper can provide multiple services.
Example:
One helper may offer:
* झाड़ू-पोंछा
* बर्तन
* घर की सफाई
Another may offer:
* खाना बनाना
* रसोई की मदद
Another may offer:
* Baby Care
* बच्चों की मालिश
Create the appropriate pivot table and indexes.
The relationship should allow future fields such as:
* Experience for that service
* Service-specific rate
* Is primary service
* Notes
---
## 6. Helper availability
Design availability in a way that can support real searching.
For example:
* Available days
* Start time
* End time
* Morning/evening preference
* Full-time/part-time
* Immediate availability
If appropriate, create a separate availability table instead of storing everything as JSON.
The structure should allow future queries such as:
> Find part-time helpers in Vijay Nagar available Monday-Friday from 8 AM to 12 PM.
---
## 7. Service preferences / work requirements
The system should eventually support customers searching according to:
* Service
* Locality
* Experience
* Full-time / Part-time
* Salary range
* Gender where legally/ethically appropriate
* Availability
* Distance/local area
* Age range where appropriate
Design indexes and relationships with future filtering in mind.
---
## 8. Demo data — IMPORTANT
Create **realistic but completely fictional demo data** for Indore.
Do NOT use real people's personal information.
Generate approximately:
* 30–50 demo helpers
* 10–15 customer/household users
* All major service categories
* Multiple services per helper
* Multiple Indore localities
* Different experience levels
* Different salary expectations
* Full-time and part-time helpers
* Different availability schedules
* Realistic Hindi/Indian names
* Realistic but fictional phone numbers
* Fictional addresses
Use realistic Indian naming and salary patterns.
For example, salaries should vary depending on service and work type rather than using the same amount everywhere.
Example ranges for testing can be approximately:
* Part-time household work: ₹2,000–₹8,000/month
* Cooking: ₹3,000–₹10,000/month
* Baby care: ₹5,000–₹15,000/month
* Elder care: ₹5,000–₹15,000/month
* Full-time/all-rounder: ₹8,000–₹18,000+/month
These are **demo/testing values**, not claims about actual Indore market rates.
---
## 9. Realistic demo profiles
Make demo profiles varied.
For example:
**Helper A**
* Female
* Vijay Nagar
* 5 years experience
* Part-time
* Services: झाड़ू-पोंछा + बर्तन + सफाई
* Morning availability
**Helper B**
* Female
* Nipania
* 7 years experience
* Cooking
* Morning + evening
**Helper C**
* Female
* Palasia
* 4 years experience
* Baby Care + बच्चों की मालिश
**Helper D**
* Female
* Rau
* 8 years experience
* Full-time
* All-rounder
Do not simply copy these examples. Generate diverse records across the entire dataset.
---
## 10. Database quality
All migrations must include:
* Primary keys
* Foreign keys
* Proper nullable fields
* Unique constraints where appropriate
* Useful indexes
* Appropriate data types
* Timestamps
* Soft deletes where appropriate
* Cascading/restrict behavior based on the relationship
Follow Laravel conventions.
Avoid storing structured relational information unnecessarily inside JSON.
Use enums only where they make sense; otherwise use lookup/reference tables when values may expand.
---
## 11. Laravel implementation
Generate:
### Migrations
Create all required Laravel migration files.
### Models
Create/update models with:
* `$fillable`
* casts where necessary
* relationships
* scopes where useful
Expected relationships may include:
```text
User
 └── HelperProfile
HelperProfile
 ├── User
 ├── Locality
 ├── Services
 └── Availability
Service
 ├── Category
 └── Helpers
Category
 └── Services
City
 └── Localities
Locality
 └── Helpers
```
Adjust this structure if the existing project requires a better design.
---
## 12. Seeders / Factories
Create Laravel factories and seeders so the database can be populated easily.
For example:
```bash
php artisan migrate:fresh --seed
```
should create a complete development dataset.
Create predictable demo accounts where useful, for example:
```text
Admin
Customer
Helper
```
Use clearly fictional credentials and document them in the seeder/readme.
Do not hardcode real passwords or personal credentials.
---
## 13. Search-ready data
The seeded data should allow testing of queries such as:
```text
Find helpers in Vijay Nagar
Find part-time helpers
Find helpers who provide झाड़ू-पोंछा
Find cooking helpers
Find Baby Care helpers
Find helpers available in the morning
Find helpers within a locality
Find full-time all-rounders
Find helpers by experience
Find helpers by salary range
```
Add appropriate indexes for these common searches.
---
## 14. Image/profile data
If the existing application already supports profile images, add **safe demo image URLs or local placeholder handling**.
Do not invent broken URLs.
If external image URLs are used, use legitimate publicly accessible sources and make the application resilient if an image fails.
Do not use images representing identifiable real private individuals as if they were actual registered helpers.
---
## 15. Important safety/privacy rule
All seeded people must be **fictional demo users**.
Do not use:
* Real people's phone numbers
* Real home addresses
* Aadhaar numbers
* PAN numbers
* Bank details
* Real identity documents
* Other sensitive personal information
Clearly treat seeded records as development/testing data.
---
## 16. Final implementation output
After implementation, report:
1. Tables created/modified
2. Relationships
3. Important indexes
4. Migrations created
5. Models created/modified
6. Factories created
7. Seeders created
8. Number of demo users/helpers/services/localities
9. Demo login credentials, if created
10. Commands required to initialize the database
11. Any assumptions made
12. Any existing tables reused instead of duplicated
Most importantly:
**Inspect the existing Laravel database first and then implement this requirement. Do not just provide SQL/schema recommendations. Create the actual Laravel migrations, models, factories and seeders.**